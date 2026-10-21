<?php
namespace Model;

class Question_rubric extends Model {
  public $errors = [];
  protected $table = "question_rubrics";

  protected $allowedColumns = [
    'id',
    'question_id',
    'rubric_type',
    'band_score',
    'criteria',
    'notes',
    'created_at',
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['question_id'])) {
      $this->errors['question_id'] = 'Question is required.';
    }

    if (empty($data['rubric_type'])) {
      $this->errors['rubric_type'] = 'Rubric type is required.';
    }

    if (empty($data['criteria'])) {
      $this->errors['criteria'] = 'Rubric criteria are required.';
    }

    return empty($this->errors);
  }
}
