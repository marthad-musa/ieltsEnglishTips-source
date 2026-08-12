<?php

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


class Enrollment extends Model {
  public $errors = [];
  protected $table = "course_enroll";
  protected $allowedColumns = [
    'user_id',
    'course_id',
    'disabled',
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['user_id'])) {
      $this->errors['user_id'] = "User is required";
    }
    if (empty($data['course_id'])) {
      $this->errors['course_id'] = "Course is required";
    }

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }
}
