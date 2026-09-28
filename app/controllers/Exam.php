<?php

namespace Controller;

if (!defined('ROOT')) die('direct script access denied!');

class Exam extends Controller {
  private function json(array $payload, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($payload);
    exit;
  }

  private function validCsrf(): bool {
    return self::csrfMatches($_SESSION['csrf_code'] ?? null, $_POST['csrf_code'] ?? null);
  }

  public static function csrfMatches(?string $expected, ?string $provided): bool {
    return $expected !== null && $expected !== '' && $provided !== null && hash_equals($expected, $provided);
  }

  private function studentExam(int $exam_id): array {
    if (!\Model\Auth::logged_in()) {
      return [null, null, null, 'Please, log in.'];
    }

    $user_id = (int)\Model\Auth::getId();
    $user = (new \Model\User())->first(['id' => $user_id]);
    if (!$user || !\Model\Exam::canTakeForRole((int)$user->role_id)) {
      return [null, null, null, 'Only enrolled students can take exams.'];
    }

    $exam_model = new \Model\Exam();
    $exam = $exam_model->getRuntimeExam($exam_id);
    if (!$exam || !(new \Model\Exam_enroll())->canTakeExam($user_id, $exam_id)) {
      return [null, null, null, 'Exam not found or you are not enrolled.'];
    }

    return [$exam, $user_id, $exam_model, null];
  }

  private function finalize(int $exam_id, int $user_id, object $exam, bool $timed_out): ?object {
    return (new \Model\Exam_result())->finalizeStudent($exam_id, $user_id, $exam, $timed_out);
  }

  public function take($exam_id = null): void {
    if (!\Model\Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    [$exam, $user_id, $exam_model, $error] = $this->studentExam((int)$exam_id);
    if ($error) {
      message($error);
      redirect('admin/exams');
    }

    $result_model = new \Model\Exam_result();
    $attempt = $result_model->getForStudent((int)$exam->id, (int)$user_id);
    if (\Model\Exam_result::hasApprovedRetake($attempt)) {
      if (!$result_model->beginRetake((int)$exam->id, (int)$user_id)) {
        message('The approved retake could not be started.');
        redirect('exam/final-scores/' . (int)$exam->id);
      }
      $attempt = $result_model->getForStudent((int)$exam->id, (int)$user_id);
    } elseif ($attempt && $attempt->status !== 'In Progress') {
      redirect('exam/final-scores/' . (int)$exam->id);
    }

    $state = $exam_model->getScheduleState($exam, $attempt);
    if ($state === 'ended') {
      $this->finalize((int)$exam->id, (int)$user_id, $exam, true);
      if ($exam_model->getScheduleState($exam) === 'ended') {
        $exam_model->query("UPDATE exam SET exam_status = 'Completed' WHERE id = :id", ['id' => $exam->id]);
      }
      redirect('exam/final-scores/' . (int)$exam->id);
    }
    if ($state === 'active') {
      if (!$attempt) {
        if (!$result_model->startScheduledAttempt((int)$exam->id, (int)$user_id)) {
          message('Could not start your exam attempt. Please reload the exam page.');
          redirect('exam/take/' . (int)$exam->id);
        }
        $attempt = $result_model->getForStudent((int)$exam->id, (int)$user_id);
      }
      $exam_model->query("UPDATE exam SET exam_status = 'Started' WHERE id = :id AND exam_status <> 'Completed'", ['id' => $exam->id]);
      $exam_model->query("UPDATE exam_enroll SET attendance_status = 'Present' WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0", ['exam_id' => $exam->id, 'user_id' => $user_id]);
    }

    $questions = [];
    $saved_answers = [];
    $deadline = null;
    if ($state === 'active') {
      foreach ((new \Model\Question())->getForStudent((int)$exam->id) as $row) {
        $question_id = (int)$row->id;
        if (!isset($questions[$question_id])) {
          $questions[$question_id] = ['id' => $question_id, 'title' => $row->question_title, 'options' => []];
        }
        $questions[$question_id]['options'][] = [
          'id' => (int)$row->option_id,
          'number' => (int)$row->option_number,
          'title' => $row->option_title,
        ];
      }
      foreach ((new \Model\Exam_answer())->getUserAnswers((int)$exam->id, (int)$user_id) ?: [] as $answer) {
        $saved_answers[(int)$answer->question_id] = (int)$answer->selected_option_id;
      }
      $deadline = $exam_model->getDeadline($exam, $attempt);
    }

    $this->view('exam-take', [
      'title' => $exam->exam_title,
      'uid' => (new \Model\User())->first(['id' => (int)$user_id]),
      'exam' => $exam,
      'state' => $state,
      'attempt' => $attempt,
      'questions' => array_values($questions),
      'saved_answers' => $saved_answers,
      'deadline' => $deadline,
      'server_now' => time(),
      'csrf_code' => $_SESSION['csrf_code'] ?? '',
    ]);
  }

  public function save_answer(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$this->validCsrf()) {
      $this->json(['success' => false, 'message' => 'Security check failed.'], 403);
    }
    [$exam, $user_id, $exam_model, $error] = $this->studentExam((int)($_POST['exam_id'] ?? 0));
    if ($error) $this->json(['success' => false, 'message' => $error], 403);
    $result_model = new \Model\Exam_result();
    $attempt = $result_model->getForStudent((int)$exam->id, (int)$user_id);
    if (\Model\Exam_result::hasApprovedRetake($attempt)) {
      $this->json(['success' => false, 'message' => 'Open the exam page to begin your approved retake.'], 409);
    }
    if ($exam_model->getScheduleState($exam, $attempt) !== 'active' || ($attempt && $attempt->status !== 'In Progress')) {
      $this->json(['success' => false, 'message' => 'This exam is no longer accepting answers.'], 409);
    }

    $saved = (new \Model\Exam_answer())->saveAnswer(
      (int)$exam->id,
      (int)$user_id,
      (int)($_POST['question_id'] ?? 0),
      (int)($_POST['option_id'] ?? 0)
    );
    if (!$saved) $this->json(['success' => false, 'message' => 'Invalid question or answer option.'], 422);
    $this->json(['success' => true]);
  }

  public function submit($exam_id = null): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$this->validCsrf()) {
      $this->json(['success' => false, 'message' => 'Security check failed.'], 403);
    }
    [$exam, $user_id, $exam_model, $error] = $this->studentExam((int)$exam_id);
    if ($error) $this->json(['success' => false, 'message' => $error], 403);

    $result_model = new \Model\Exam_result();
    $attempt = $result_model->getForStudent((int)$exam->id, (int)$user_id);
    if (\Model\Exam_result::hasApprovedRetake($attempt)) {
      $this->json(['success' => false, 'message' => 'Open the exam page to begin your approved retake.'], 409);
    }
    $state = $exam_model->getScheduleState($exam, $attempt);
    if ($state === 'waiting' || $state === 'invalid') {
      $this->json(['success' => false, 'message' => 'The exam is not accepting submissions.'], 409);
    }
    $this->finalize((int)$exam->id, (int)$user_id, $exam, $state === 'ended');
    if ($state === 'ended' && $exam_model->getScheduleState($exam) === 'ended') {
      $exam_model->query("UPDATE exam SET exam_status = 'Completed' WHERE id = :id", ['id' => $exam->id]);
    }
    $this->json(['success' => true, 'redirect' => ROOT . '/exam/final-scores/' . (int)$exam->id]);
  }

  public function final_scores($exam_id = null): void {
    if (!\Model\Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    $user_id = (int)\Model\Auth::getId();
    $user = (new \Model\User())->first(['id' => $user_id]);
    $role_id = (int)($user->role_id ?? 0);
    $exam_model = new \Model\Exam();
    $result_model = new \Model\Exam_result();
    $database = new \Database();

    if ($role_id === 1) {
      $result_model->finalizeExpiredAttempts($user_id);
      $query = "SELECT er.*, e.exam_title FROM exam_results er JOIN exam e ON e.id = er.exam_id
        WHERE er.user_id = :user_id AND er.disabled = 0 AND er.status IN ('Submitted', 'Approved')";
      $params = ['user_id' => $user_id];
      if ($exam_id !== null) {
        $query .= " AND er.exam_id = :exam_id";
        $params['exam_id'] = (int)$exam_id;
      }
      $query .= " ORDER BY er.submitted_at DESC";
      $results = $database->query($query, $params) ?: [];
    } elseif (in_array($role_id, [2, 3], true)) {
      $query = "SELECT er.*, e.exam_title, u.firstname, u.lastname, u.email FROM exam_results er
        JOIN exam e ON e.id = er.exam_id JOIN users u ON u.id = er.user_id
        WHERE er.disabled = 0 AND er.status IN ('Submitted', 'Approved')";
      $params = [];
      if ($role_id === 2) {
        $query .= " AND (e.created_by = :owner_id OR e.user_id = :legacy_owner_id)";
        $params['owner_id'] = $user_id;
        $params['legacy_owner_id'] = $user_id;
      }
      if ($exam_id !== null) {
        $query .= " AND er.exam_id = :exam_id";
        $params['exam_id'] = (int)$exam_id;
      }
      $query .= " ORDER BY er.submitted_at DESC";
      $results = $database->query($query, $params) ?: [];
    } else {
      message('You are not allowed to view exam results.');
      redirect('admin/dashboard');
    }

    $this->view('exam-final-scores', ['title' => 'Final Scores', 'uid' => $user, 'results' => $results, 'role_id' => $role_id]);
  }

  /** Public exam landing page retained from the existing controller. */
  # -----| Index() | -----
  public function index($slug = null) {
    $course = new \Model\Course();
    $course_meta = new \Model\Course_meta();

    $data['title'] = "Exam";
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>1,'published'=>1], 'desc', 10);

    # ...| READ The Course Data
    $data['row'] = $row = $course->first(['slug'=>$slug]);

    # ...| READ ALL Courses Metas
    $coursesMetas = $course_meta->where(['disabled'=>0,'course_id'=>$row->id ?? null], 'desc');
    if ($coursesMetas) {
      # ...| TRUE Block
      $data['coursesMeta'] = $coursesMetas;
    }
    # ---| ./IF(Courses Metas)

    # ...| READ ALL Courses Order by Trending Value
    $query = "select * from courses where approved = 1 and published = 1 order by trending desc limit 5";
    $data['trending'] = $course->query($query);

    if ($data['rows']) {
      # ...| TRUE Block
      $data['first_row'] = $data['rows'][0];
      unset($data['rows'][0]);

      $total_rows = count($data['rows']);
      $half_rows = round($total_rows / 2);

      /**
       * Splice()
       * *
       * a method that split an array() acourding to it's offset
       * and the data it removes will be excluded from the whole array.
       */
      $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
      $data['rows2'] = $data['rows'];
    }
    # ---| ./IF(Rows)

    $this->view('exam',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Exam Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Exam()
