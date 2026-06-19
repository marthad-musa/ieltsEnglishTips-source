<?php

namespace Model;

// Minimal Exam model stub
class Exam extends \Model {
  protected $table = 'exam';
  public $errors = [];

  public function validate($data) {
    // basic placeholder validation
    $this->errors = [];
    if (empty($data['title'])) {
      $this->errors['title'] = 'Title is required';
      return false;
    }
    return true;
  }
}
