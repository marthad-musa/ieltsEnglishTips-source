<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Courses()
 * *
 * The Courses Page
 */
class Courses extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Courses";

    $this->view('courses',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Courses Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Courses()
