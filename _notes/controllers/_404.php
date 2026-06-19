<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * _404()
 * *
 * Page Not Found!
 */
class _404 {
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
