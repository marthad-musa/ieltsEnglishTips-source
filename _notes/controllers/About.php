<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * About()
 * *
 * The About Page
 */
class About extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "About";

    $this->view('about',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "About Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./About()
