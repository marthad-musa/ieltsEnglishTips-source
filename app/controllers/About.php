<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * About()
 * *
 * Page Not Found!
 */
class About extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "about";
    $this->view('about',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "about, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./About()\. | ---
