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
 * Exam_answer()
 * *
 * The Exam Answer MODEL
 */
class Exam_answer extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "exam_answers";

  protected $afterSelect = [];
  protected $beforeUpdate = [];

  protected $allowedColumns = [
    'id',
    'exam_id',
    'user_id',
    'question_id',
    'selected_option_id',
    'is_correct',
    'submitted_at',
    'disabled',
  ];
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

    # ...| QUESTION_ID Block
    if(empty($data['question_id'])) {
      $this->errors['question_id'] = "Question ID is required!";
    }
    # ---| ./IF(QUESTION_ID)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(empty($this->errors))

    return false;
  }
  # ---| ./Validate()\. | ---

  # -----| Get User Answers |-----
  public function getUserAnswers($exam_id, $user_id) {
    $query = "SELECT * FROM exam_answers WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 ORDER BY question_id";
    return $this->query($query, ['exam_id' => $exam_id, 'user_id' => $user_id], 'object');
  }
  # ---| ./Get User Answers\. | ---

  # -----| Count Correct Answers |-----
  public function countCorrectAnswers($exam_id, $user_id) {
    $query = "SELECT COUNT(*) as count FROM exam_answers WHERE exam_id = :exam_id AND user_id = :user_id AND is_correct = 1 AND disabled = 0";
    $result = $this->query($query, ['exam_id' => $exam_id, 'user_id' => $user_id], 'object');
    return $result[0]->count ?? 0;
  }

  public function saveAnswer(int $exam_id, int $user_id, int $question_id, int $option_id): bool {
    $database = new \Database();
    $database->beginTransaction();
    try {
      $exam_rows = $database->query(
        "SELECT id, exam_datetime, exam_duration, approved, published, disabled FROM exam WHERE id = :exam_id LIMIT 1",
        ['exam_id' => $exam_id]
      );
      $exam = $exam_rows[0] ?? null;
      $attempt_rows = $database->query(
        "SELECT status, retake_started_at FROM exam_results WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 FOR UPDATE",
        ['exam_id' => $exam_id, 'user_id' => $user_id]
      );
      $attempt = $attempt_rows[0] ?? null;
      if (!$exam || (int)$exam->approved !== 1 || (int)$exam->published !== 1 || (int)$exam->disabled !== 0 || !$attempt || $attempt->status !== 'In Progress') {
        $database->rollBackTransaction();
        return false;
      }
      if ($attempt && in_array($attempt->status, ['Submitted', 'Approved'], true)) {
        $database->rollBackTransaction();
        return false;
      }
      if ((new Exam())->getScheduleState($exam, $attempt) !== 'active') {
        $database->rollBackTransaction();
        return false;
      }

      $valid_option = $database->query(
        "SELECT qo.id, qo.option_number, q.answer_option
         FROM question_option qo
         JOIN question q ON q.id = qo.question_id
         WHERE q.id = :question_id AND q.exam_id = :exam_id AND qo.id = :option_id
         LIMIT 1",
        ['question_id' => $question_id, 'exam_id' => $exam_id, 'option_id' => $option_id]
      );
      if (!$valid_option) {
        $database->rollBackTransaction();
        return false;
      }

      $is_correct = (string)$valid_option[0]->option_number === (string)$valid_option[0]->answer_option ? 1 : 0;
      $database->query(
        "INSERT INTO exam_answers (exam_id, user_id, question_id, selected_option_id, is_correct, submitted_at, disabled)
         VALUES (:exam_id, :user_id, :question_id, :selected_option_id, :is_correct, NOW(), 0)
         ON DUPLICATE KEY UPDATE selected_option_id = VALUES(selected_option_id), is_correct = VALUES(is_correct), submitted_at = VALUES(submitted_at), disabled = 0",
        [
          'exam_id' => $exam_id,
          'user_id' => $user_id,
          'question_id' => $question_id,
          'selected_option_id' => $option_id,
          'is_correct' => $is_correct,
        ]
      );
      $database->commitTransaction();
      return true;
    } catch (\Throwable $error) {
      $database->rollBackTransaction();
      throw $error;
    }
  }

  public function calculateResult(int $exam_id, int $user_id, float $right_mark, float $wrong_mark): array {
    $database = new \Database();
    $query = "SELECT COUNT(q.id) AS total_count,
        SUM(CASE WHEN a.id IS NOT NULL AND a.disabled = 0 AND selected.id IS NOT NULL AND selected.option_number = q.answer_option THEN 1 ELSE 0 END) AS correct_count,
        SUM(CASE WHEN a.id IS NOT NULL AND a.disabled = 0 AND selected.id IS NOT NULL AND selected.option_number <> q.answer_option THEN 1 ELSE 0 END) AS wrong_count,
        SUM(CASE WHEN a.id IS NULL OR a.disabled = 1 OR selected.id IS NULL THEN 1 ELSE 0 END) AS unanswered_count
      FROM question q
      LEFT JOIN exam_answers a ON a.exam_id = q.exam_id AND a.question_id = q.id AND a.user_id = :user_id
      LEFT JOIN question_option selected ON selected.id = a.selected_option_id AND selected.question_id = q.id
      WHERE q.exam_id = :exam_id";
    $rows = $database->query($query, ['exam_id' => $exam_id, 'user_id' => $user_id]);
    $counts = $rows[0] ?? (object)['total_count' => 0, 'correct_count' => 0, 'wrong_count' => 0, 'unanswered_count' => 0];
    $total = (int)$counts->total_count;
    $correct = (int)$counts->correct_count;
    $wrong = (int)$counts->wrong_count;
    $unanswered = (int)$counts->unanswered_count;
    return $this->scoreCounts($total, $correct, $wrong, $unanswered, $right_mark, $wrong_mark);
  }

  public function scoreCounts(int $total, int $correct, int $wrong, int $unanswered, float $right_mark, float $wrong_mark): array {
    $score = ($correct * $right_mark) + ($wrong * $wrong_mark);
    $maximum = $total * $right_mark;
    return [
      'total_count' => $total,
      'correct_count' => $correct,
      'wrong_count' => $wrong,
      'unanswered_count' => $unanswered,
      'score' => round($score, 2),
      'percentage' => $maximum > 0 ? round(max(0, min(100, ($score / $maximum) * 100)), 2) : 0,
    ];
  }
  # ---| ./Count Correct Answers\. | ---

}
# -----| ./Exam_answer()
