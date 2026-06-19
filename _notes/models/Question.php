<?php

namespace Model;

// Minimal Question model stub
class Question extends \Model {
  protected $table = 'question';
  public $errors = [];

  public function validate($data) {
    $this->errors = [];
    if (empty($data['question'])) {
      $this->errors['question'] = 'Question text is required';
      return false;
    }
    return true;
  }
}
