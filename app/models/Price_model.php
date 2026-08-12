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
  protected $afterSelect = [
    'get_currency',
  ];
  protected $allowedColumns = [
    'name',
    'price',
    'currency_id',
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

    # ...| Price-Symbol Block
    if(empty($data['symbol'])) {
      $this->errors['symbol'] = "A price symbol is required!";
    }
    # ---| ./IF(Price-Symbol)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---

  protected function get_currency (mixed $rows) :mixed {
    $db = new \Database();
    if (!empty($rows[0]->id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select currency, symbol from currencies where id = :id && disabled = 0 limit 1";
        $currency = $db->query($query,['id'=>$row->currency_id]);
        if (!empty($currency)) {
          # ...| TRUE Block
          $rows[$key]->currency_row = $currency[0];
        }
        # ---| ./IF(EXAM)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  }
  # ---| ./Get_Currency()\. |---
}
# -----| ./Price_Model()
