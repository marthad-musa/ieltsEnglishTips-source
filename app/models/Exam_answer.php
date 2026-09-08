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
    $query = "SELECT * FROM exam_answers WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0";
    return $this->query($query, ['exam_id' => $exam_id, 'user_id' => $user_id], 'object');
  }
  # ---| ./Get User Answers\. | ---

  # -----| Count Correct Answers |-----
  public function countCorrectAnswers($exam_id, $user_id) {
    $query = "SELECT COUNT(*) as count FROM exam_answers WHERE exam_id = :exam_id AND user_id = :user_id AND is_correct = 1 AND disabled = 0";
    $result = $this->query($query, ['exam_id' => $exam_id, 'user_id' => $user_id], 'object');
    return $result[0]->count ?? 0;
  }
  # ---| ./Count Correct Answers\. | ---

}
# -----| ./Exam_answer()
