<?php

/**
 * User: TECH-Tag
 * Date: 11/01/2025
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * AUTH()
 * *
 * AUTHENTICATION CLASS
 */
class Auth {
  # -----| AUTHENTICATION | -----
  public static function authenticate($row) {
    if (is_object($row)) {
      # ...| TRUE Block
      $_SESSION['USER_DATA'] = $row;
    }
    # ---| ./IF(is_object())
  }
  # ---| ./AUTHENTICATION\. | ---
  
  # -----| Logout() | -----
  public static function logout() {
    if (!empty($_SESSION['USER_DATA'])) {
      # ...| TRUE Block
      unset($_SESSION['USER_DATA']);

    //   session_unset();
    //   session_regenerate_id();
    }
    # ---| ./IF(is_object())
  }
  # ---| ./Logout()\. | ---

  # -----| Logged_in() | -----
  public static function logged_in() {
    if (!empty($_SESSION['USER_DATA'])) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF($_SESSION[])

    return false;
  }
  # ---| ./Logged_in()\. | ---

  
  # -----| IS_ADMIN() | -----
  public static function is_admin() {
    if (!empty($_SESSION['USER_DATA'])) {
      # ...| TRUE Block
      if (!empty($_SESSION['USER_DATA']->role_name)) {
        # ...| TRUE Block
        if (strtolower($_SESSION['USER_DATA']->role_name) == 'admin') {
          # ...| TRUE Block
          return true;
        }
        # ---| ./IF(role = 'admin')
      }
      # ---| ./IF(ROW)
      
    }
    # ---| ./IF($_SESSION[])

    return false;
  }
  # ---| ./IS_ADMIN()\. | ---

  # -----| Call() | -----
  public static function __callStatic($funcname, $args) {
    $key = str_replace("get", "", strtolower($funcname));

    if (!empty($_SESSION['USER_DATA']->$key)) {
      # ...| TRUE Block
      return $_SESSION['USER_DATA']->$key;
    }
    # ---| ./IF(USER_DATA)

    return '';
  }
  # ---| ./Call()\. | ---
}
# ------------|  ./AUTH()
