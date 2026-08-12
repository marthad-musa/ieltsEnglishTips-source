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

use \Model\Auth;

/**
 * Logout()
 * *
 * The Logout Page
 */
class Logout extends Controller {
  # -----| Index() | -----
  public function index() {
    Auth::logout();

    redirect('login');
  }
  # ---| ./Index()\. | ---
}
# -----| ./Logout()
