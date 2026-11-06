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
 * Explore()
 * *
 * The Explore Page!
 */
class Explore extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Explore";
    $this->view('explore',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "explore, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Explore()\. | ---
