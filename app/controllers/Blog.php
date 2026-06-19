<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Blog()
 * *
 * Page Not Found!
 */
class Blog extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Blog";
    $this->view('blog',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "contact, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Blog()\. | ---
