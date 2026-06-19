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
 * Price_Model()
 * *
 * The Prices MODEL
 */
class Price_model extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "prices";
  protected $allowedColumns = [
    'name',
    'price',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Price Block
    if(empty($data['price'])) {
      $this->errors['price'] = "Price is required!";
    }
    # ---| ./IF(Price)

    # ...| Price-Name Block
    if(empty($data['name'])) {
      $this->errors['name'] = "A price name is required!";
    }
    # ---| ./IF(Price-Name)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Price_Model()
