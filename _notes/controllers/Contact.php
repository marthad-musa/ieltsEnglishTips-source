<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Contact()
 * *
 * The Contact Page
 */
class Contact extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Contact";

    $this->view('contact',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Contact Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Contact()
