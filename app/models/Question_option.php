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
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Question_Option()
 * *
 * The Questions Option MODEL
 */
class Question_option extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "question_option";

  protected $afterSelect = [
    'get_question_id',
  ];

  protected $beforeUpdate = [];
  // protected $afterDelete = [];

  protected $allowedColumns = [
    'id',
    'question_id',
    'option_number',
    'option_title',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| TITLE Block
    if(empty($data['option_title'])) {
      $this->errors['option_title'] = "Option title is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['option_title']))) {
      $this->errors['option_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. |---


  # -----| EDIT_Validate() |-----
  public function edit_validate($data,$id = null) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler Depending on TAB-Names |-----
    # ...| TITLE Block
    if(empty($data['option_title'])) {
      $this->errors['option_title'] = "Option title is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['title']))) {
      $this->errors['option_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./EDIT_Validate()\. |---


  # -----| AfterSELECT Functions |-----
  protected function get_question_id($rows) {
    $db = new \Database();
    if (!empty($rows[0]->question_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from question where id = :id limit 1";
        $question = $db->query($query,['id'=>$row->question_id]);
        if (!empty($question)) {
          # ...| TRUE Block
          $rows[$key]->question_row = $question[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_USER() |---

  public function getByQuestionId(int $question_id): array {
    $database = new \Database();
    return $database->query(
      "SELECT id, question_id, option_number, option_title FROM question_option WHERE question_id = :question_id ORDER BY option_number ASC",
      ['question_id' => $question_id]
    ) ?: [];
  }

  public function hasFourOptions(int $question_id): bool {
    $options = $this->getByQuestionId($question_id);
    return self::hasExactOptionNumbers(array_map(static function($option) {
      return $option->option_number;
    }, $options));
  }

  public static function hasExactOptionNumbers(array $numbers): bool {
    if (count($numbers) !== 4) return false;
    $numbers = array_map('intval', $numbers);
    sort($numbers, SORT_NUMERIC);
    return $numbers === [1, 2, 3, 4];
  }
  # ---| ./AfterSELECT Functions\. |---
}
# -----| ./Question_Option()
