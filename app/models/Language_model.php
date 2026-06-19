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
 * Language_Model()
 * *
 * The Languages MODEL
 */
class Language_model extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "languages";
  protected $allowedColumns = [
    'symbol',
    'language',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Language Block
    if(empty($data['language'])) {
      $this->errors['language'] = "Language is required!";
    }
    # ---| ./IF(Language)

    # ...| Symbol Block
    if(empty($data['symbol'])) {
      $this->errors['symbol'] = "A short form is required!";
    }
    # ---| ./IF(Symbol)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Language_Model()
