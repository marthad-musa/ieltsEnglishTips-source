<?php

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Level_Model()
 * *
 * The Levels MODEL
 */
class Level_model extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "course_levels";
  protected $allowedColumns = [
    'level',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Level Block
    if(empty($data['level'])) {
      $this->errors['level'] = "Level is required!";
    }
    # ---| ./IF(Level)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Level_Model()
