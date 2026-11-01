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
 * Reading()
 * *
 * The Reading Page!
 */
class Reading extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Reading";
    $this->view('reading',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "reading, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Reading()\. | ---
