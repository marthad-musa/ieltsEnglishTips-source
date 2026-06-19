<?php

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
