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
 * Category()
 * *
 * The Categories MODEL
 */
class Category extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "categories";
  protected $allowedColumns = [
    'category',
    'slug',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Category Block
    if(empty($data['category'])) {
      $this->errors['category'] = "Category is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \&\']+$/", trim($data['category']))) {
      $this->errors['category'] = "Only letters, numbers, spaces and special charactors are allowed!";
    }
    # ---| ./IF/ELSE(Category)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Category()
