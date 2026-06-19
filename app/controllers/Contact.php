<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Contact()
 * *
 * Page Not Found!
 */
class Contact extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "contact";
    $this->view('contact',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "contact, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Contact()\. | ---
