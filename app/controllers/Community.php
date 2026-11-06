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
 * Community()
 * *
 * The Community Page!
 */
class Community extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "Community";
    $this->view('community',$data);
  }
  # ---| ./Index()\. | ---
  
  # -----| __Constructor() |-----
  // function __construct() {
  //   echo "community, Page Not Found!";
  // }
  # ---| ./__Constructor()\. | ---
}
# -----| ./Community()\. | ---
