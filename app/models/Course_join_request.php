<?php

namespace Model;

class Course_join_request extends Model {
  public $errors = [];
  protected $table = "course_join_requests";
  protected $allowedColumns = [
    'course_id',
    'user_id',
    'status',
    'requested_at',
    'approved_by',
    'approved_at',
    'notes',
    'disabled',
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['course_id'])) {
      $this->errors['course_id'] = "Course is required";
    }

    if (empty($data['user_id'])) {
      $this->errors['user_id'] = "Student is required";
    }

    if (empty($data['status'])) {
      $this->errors['status'] = "Status is required";
    }

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }
}
