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
