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
 * Currency_Model()
 * *
 * The Currencies MODEL
 */
class Currency_model extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "currencies";
  protected $allowedColumns = [
    'carrency',
    'symbol',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Currency Block
    if(empty($data['currency'])) {
      $this->errors['currency'] = "Currency is required!";
    }
    # ---| ./IF(Currency)

    # ...| Currency-Symbol Block
    if(empty($data['symbol'])) {
      $this->errors['symbol'] = "A currency symbol is required!";
    }
    # ---| ./IF(Currency-Symbol)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Currency_Model()
