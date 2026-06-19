<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * _404()
 * *
 * Page Not Found!
 */
class _404 extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "404";
    $this->view('404',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "404, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./_404()\. | ---
