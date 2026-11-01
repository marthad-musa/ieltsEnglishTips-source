<?php

/**
 * User: TECH-Tag
 * Date: 08/16/2025
 * Time: 07:37 PM
 * * *
 * @author  Marthad Musa <marthad.musa@gmail.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * WhatToLearn()
 * *
 * Page Not Found!
 */
class WhatToLearn extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "What to Learn";
    $this->view('whattolearn',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "what-to-learn, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./WhatToLearn()\. | ---
