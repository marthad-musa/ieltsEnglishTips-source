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
 * Slider()
 * *
 * The Images Slider MODEL
 */
class Slider extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "slider_images";
  protected $allowedColumns = [
    'id',
    'image',
    'title',
    'description',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Title Block
    if(empty($data['title'])) {
      $this->errors['title'] = "A slider title is required!";
    }
    # ---| ./IF(Title)

    # ...| Description Block
    if(empty($data['description'])) {
      $this->errors['description'] = "A slider description is required!";
    }
    # ---| ./IF(Description)

    # ...| Image Block
    if(empty($data['image'])) {
      $this->errors['image'] = "A slider image is required!";
    }
    # ---| ./IF(Image)

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
