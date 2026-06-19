<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Faculty()
 * *
 * The Faculty Page
 */
class Faculty extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Faculty";

    $this->view('faculty',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Faculty Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Faculty()
