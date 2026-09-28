<?php

/**
 * User: TECH-Tag
 * Date: 08/16/2025
 * Time: 07:37 PM
 * * *
 * @author  Marthad Musa <marthad.musa@gmail.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
if (!defined("ROOT")) die ("direct script access denied!");
# ------------|  ./SECURITY CHECK


/**
 * Exam_result()
 * *
 * The Exam Result MODEL
 */
class Exam_result extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "exam_results";

  protected $afterSelect = [
    'get_user_info',
    'get_exam_info',
  ];
  protected $beforeUpdate = [];

  protected $allowedColumns = [
    'id',
    'exam_id',
    'user_id',
    'score',
    'percentage',
    'status',
    'submitted_at',
    'reviewed_by',
    'approved_at',
    'retake_allowed',
    'retake_started_at',
    'notes',
    'disabled',
    'correct_count',
    'wrong_count',
    'unanswered_count',
  ];

  public static function isFinalStatus(string $status): bool {
    return in_array($status, ['Submitted', 'Approved'], true);
  }

  public static function hasApprovedRetake(?object $result): bool {
    return $result !== null && $result->status === 'Approved' && (int)$result->retake_allowed === 1;
  }
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| EXAM_ID Block
    if(empty($data['exam_id'])) {
      $this->errors['exam_id'] = "Exam ID is required!";
    }
    # ---| ./IF(EXAM_ID)

    # ...| USER_ID Block
    if(empty($data['user_id'])) {
      $this->errors['user_id'] = "User ID is required!";
    }
    # ---| ./IF(USER_ID)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(empty($this->errors))

    return false;
  }
  # ---| ./Validate()\. | ---

  # -----| Get User Info |-----
  public function get_user_info($data) {
    $user = new User();
    if(is_array($data)) {
      foreach($data as $object) {
        $result = $user->first(['id' => $object->user_id ?? null]);
        $object->user = $result;
      }
    }
    return $data;
  }
  # ---| ./Get User Info\. | ---

  # -----| Get Exam Info |-----
  public function get_exam_info($data) {
    $exam = new Exam();
    if(is_array($data)) {
      foreach($data as $object) {
        $result = $exam->first(['id' => $object->exam_id ?? null]);
        $object->exam = $result;
      }
    }
    return $data;
  }
  # ---| ./Get Exam Info\. | ---

  # -----| Count By Exam |-----
  public function countByExam($exam_id) {
    $query = "SELECT COUNT(*) as count FROM exam_results WHERE exam_id = :exam_id AND disabled = 0";
    $result = $this->query($query, ['exam_id' => $exam_id], 'object');
    return $result[0]->count ?? 0;
  }
  # ---| ./Count By Exam\. | ---

  # -----| Get Results By Status |-----
  public function getResultsByStatus($exam_id, $status) {
    $query = "SELECT * FROM exam_results WHERE exam_id = :exam_id AND status = :status AND disabled = 0 ORDER BY submitted_at DESC";
    return $this->query($query, ['exam_id' => $exam_id, 'status' => $status], 'object');
  }

  public function getForStudent(int $exam_id, int $user_id): ?object {
    $rows = $this->query(
      "SELECT * FROM exam_results WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 LIMIT 1",
      ['exam_id' => $exam_id, 'user_id' => $user_id]
    );
    return $rows[0] ?? null;
  }

  public function startScheduledAttempt(int $exam_id, int $user_id): bool {
    $database = new \Database();
    $database->query(
      "INSERT IGNORE INTO exam_results (exam_id, user_id, score, percentage, status, disabled, correct_count, wrong_count, unanswered_count)
       VALUES (:exam_id, :user_id, 0, 0, 'In Progress', 0, 0, 0, 0)",
      ['exam_id' => $exam_id, 'user_id' => $user_id]
    );
    $attempt = $this->getForStudent($exam_id, $user_id);
    return $attempt !== null && $attempt->status === 'In Progress';
  }

  public function beginRetake(int $exam_id, int $user_id): bool {
    $database = new \Database();
    $database->beginTransaction();
    try {
      $rows = $database->query(
        "SELECT id, status, retake_allowed FROM exam_results WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 FOR UPDATE",
        ['exam_id' => $exam_id, 'user_id' => $user_id]
      );
      $result = $rows[0] ?? null;
      if (!self::hasApprovedRetake($result)) {
        $database->rollBackTransaction();
        return false;
      }

      $database->query(
        "DELETE FROM exam_answers WHERE exam_id = :exam_id AND user_id = :user_id",
        ['exam_id' => $exam_id, 'user_id' => $user_id]
      );
      $database->query(
        "UPDATE exam_results SET status = 'In Progress', retake_allowed = 0, retake_started_at = :retake_started_at, score = 0, percentage = 0, submitted_at = NULL, reviewed_by = NULL, approved_at = NULL, notes = NULL, correct_count = 0, wrong_count = 0, unanswered_count = 0 WHERE id = :id",
        ['id' => $result->id, 'retake_started_at' => date('Y-m-d H:i:s')]
      );
      $database->commitTransaction();
      return true;
    } catch (\Throwable $error) {
      $database->rollBackTransaction();
      throw $error;
    }
  }

  public function finalizeStudent(int $exam_id, int $user_id, object $exam, bool $timed_out): ?object {
    $database = new \Database();
    $database->beginTransaction();
    try {
      $rows = $database->query(
        "SELECT id, status FROM exam_results WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 FOR UPDATE",
        ['exam_id' => $exam_id, 'user_id' => $user_id]
      );
      $existing = $rows[0] ?? null;
      if ($existing && self::isFinalStatus($existing->status)) {
        $database->commitTransaction();
        return $this->getForStudent($exam_id, $user_id);
      }

      $result = (new Exam_answer())->calculateResult(
        $exam_id,
        $user_id,
        (float)$exam->right_answer_mark,
        (float)$exam->wrong_answer_mark
      );
      $this->saveFinal($exam_id, $user_id, $result, $timed_out);
      $database->commitTransaction();
      return $this->getForStudent($exam_id, $user_id);
    } catch (\Throwable $error) {
      $database->rollBackTransaction();
      throw $error;
    }
  }

  public function finalizeExpiredAttempts(?int $user_id = null): int {
    $database = new \Database();
    $ended_exams = $database->query(
      "SELECT id, exam_datetime, exam_duration FROM exam WHERE approved = 1 AND published = 1 AND disabled = 0"
    ) ?: [];
    $exam_model = new Exam();
    foreach ($ended_exams as $exam_row) {
      if ($exam_model->getScheduleState($exam_row) === 'ended') {
        $database->query(
          "UPDATE exam SET exam_status = 'Completed' WHERE id = :id AND exam_status <> 'Completed'",
          ['id' => $exam_row->id]
        );
      }
    }

    $query = "SELECT e.id, e.exam_title, e.exam_datetime, e.exam_duration, e.right_answer_mark, e.wrong_answer_mark, e.exam_status,
        ee.user_id, er.id AS result_id, er.status AS attempt_status, er.retake_started_at
      FROM exam e
      JOIN exam_enroll ee ON ee.exam_id = e.id AND ee.disabled = 0
      LEFT JOIN exam_results er ON er.exam_id = e.id AND er.user_id = ee.user_id AND er.disabled = 0
      WHERE e.approved = 1 AND e.published = 1 AND e.disabled = 0
        AND (er.id IS NULL OR er.status = 'In Progress')";
    $params = [];
    if ($user_id !== null) {
      $query .= " AND ee.user_id = :user_id";
      $params['user_id'] = $user_id;
    }
    $attempts = $database->query($query, $params) ?: [];
    $finalized = 0;
    $exam_model = new Exam();

    foreach ($attempts as $row) {
      $attempt = $row->result_id
        ? (object)['status' => $row->attempt_status, 'retake_started_at' => $row->retake_started_at]
        : null;
      if ($exam_model->getScheduleState($row, $attempt) !== 'ended') continue;

      $this->finalizeStudent((int)$row->id, (int)$row->user_id, $row, true);
      $finalized++;
    }

    return $finalized;
  }

  public function saveFinal(int $exam_id, int $user_id, array $result, bool $timed_out): void {
    $database = new \Database();
    $database->query(
      "INSERT INTO exam_results (exam_id, user_id, score, percentage, status, submitted_at, notes, disabled, correct_count, wrong_count, unanswered_count)
       VALUES (:exam_id, :user_id, :score, :percentage, 'Submitted', NOW(), :notes, 0, :correct_count, :wrong_count, :unanswered_count)
       ON DUPLICATE KEY UPDATE score = IF(status = 'In Progress', VALUES(score), score), percentage = IF(status = 'In Progress', VALUES(percentage), percentage), submitted_at = IF(status = 'In Progress', VALUES(submitted_at), submitted_at), notes = IF(status = 'In Progress', VALUES(notes), notes), correct_count = IF(status = 'In Progress', VALUES(correct_count), correct_count), wrong_count = IF(status = 'In Progress', VALUES(wrong_count), wrong_count), unanswered_count = IF(status = 'In Progress', VALUES(unanswered_count), unanswered_count), status = IF(status = 'In Progress', 'Submitted', status)",
      [
        'exam_id' => $exam_id,
        'user_id' => $user_id,
        'score' => $result['score'],
        'percentage' => $result['percentage'],
        'notes' => $timed_out ? 'Timed out' : null,
        'correct_count' => $result['correct_count'],
        'wrong_count' => $result['wrong_count'],
        'unanswered_count' => $result['unanswered_count'],
      ]
    );
  }
  # ---| ./Get Results By Status\. | ---

}
# -----| ./Exam_result()
