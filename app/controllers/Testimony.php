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
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Testimony()
 * *
 * The Testimony Page!
 */
class Testimony extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Testimony";
    $this->view('testimony',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "testimony, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Testimony()\. | ---
