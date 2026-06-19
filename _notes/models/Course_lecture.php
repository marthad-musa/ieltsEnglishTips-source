<?php

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Course_Lecture()
 * *
 * Lectures used for each Course SECTION|CURRICULUM
 */
class Course_lecture extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "courses_lectures";
  protected $allowedColumns = [
    'unid',
    'title',
    'description',
    'file',
    'disabled',
  ];
  # ---| ./Properties\. | ---

  # -----| Lectures() | -----
  public function lecture($data = null) {
    # -----| Reset Errors Array() | -----
    // $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----|  |-----
    return $data;
    # ---| ./\. |---
  }
  # ---| ./Lectures()\. | ---

  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Currency Block
    // if(empty($data['currency'])) {
    //   $this->errors['currency'] = "Currency is required!";
    // }
    # ---| ./IF(Currency)

    # ...| Currency-Symbol Block
    // if(empty($data['symbol'])) {
    //   $this->errors['symbol'] = "A currency symbol is required!";
    // }
    # ---| ./IF(Currency-Symbol)

    // if(empty($this->errors)) {
    //   # ...| TRUE Block
    //   return true;
    // }
    # ---| ./IF(ERRORS)

    // return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Course_Lecture()
