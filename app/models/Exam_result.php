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
    'notes',
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
  # ---| ./Get Results By Status\. | ---

}
# -----| ./Exam_result()
