<?php
namespace Model;

class Question_asset extends Model {
  public $errors = [];
  protected $table = "question_assets";

  protected $allowedColumns = [
    'id',
    'question_id',
    'asset_type',
    'file_name',
    'file_path',
    'mime_type',
    'caption',
    'is_primary',
    'created_at',
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['question_id'])) {
      $this->errors['question_id'] = 'Question is required.';
    }

    if (empty($data['asset_type'])) {
      $this->errors['asset_type'] = 'Asset type is required.';
    }

    if (empty($data['file_path'])) {
      $this->errors['file_path'] = 'File path is required.';
    }

    return empty($this->errors);
  }
}
