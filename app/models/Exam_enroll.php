<?php

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
if (!defined("ROOT")) die ("direct script access denied!");
# ------------|  ./SECURITY CHECK

class Exam_enroll extends Model {
  public $errors = [];
  protected $table = "exam_enroll";
  protected $allowedColumns = [
    'id',
    'user_id',
    'exam_id',
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['user_id'])) {
      $this->errors['user_id'] = "User is required";
    }
    if (empty($data['exam_id'])) {
      $this->errors['exam_id'] = "Exam is required";
    }

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }

  public function exists(int $user_id, int $exam_id): bool {
    $query = "select * from exam_enroll where user_id = :user_id && exam_id = :exam_id limit 1";
    $result = $this->query($query, ['user_id' => $user_id, 'exam_id' => $exam_id]);
    return !empty($result);
  }

  public function countByExam(int $exam_id): int {
    $query = "select count(*) as total from exam_enroll where exam_id = :exam_id";
    $result = $this->query($query, ['exam_id' => $exam_id]);
    if (!empty($result) && isset($result[0]->total)) {
      return intval($result[0]->total);
    }
    return 0;
  }

  # -----| Get Enrolled Users |-----
  public function getEnrolledUsers($exam_id) {
    $query = "SELECT u.id, u.firstname, u.lastname, u.email FROM exam_enroll ee JOIN users u ON ee.user_id = u.id WHERE ee.exam_id = :exam_id";
    return $this->query($query, ['exam_id' => $exam_id]);
  }
  # ---| ./Get Enrolled Users\. | ---

  # -----| Check If Can Take Exam |-----
  public function canTakeExam($user_id, $exam_id) {
    $query = "SELECT ee.* FROM exam_enroll ee WHERE ee.user_id = :user_id AND ee.exam_id = :exam_id";
    $result = $this->query($query, ['user_id' => $user_id, 'exam_id' => $exam_id]);
    return !empty($result);
  }
  # ---| ./Check If Can Take Exam\. | ---

}

