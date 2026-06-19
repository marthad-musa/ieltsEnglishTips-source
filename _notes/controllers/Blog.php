<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Blog()
 * *
 * The Blog Page
 */
class Blog extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Blog";

    $this->view('blog',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Blog Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Blog()
