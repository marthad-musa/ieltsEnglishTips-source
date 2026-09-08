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
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * CONTROLLER()
 * *
 * The Application Main Controller
 * Every other controller will Inherit this class
 */
class controller {
  /**
   * VIEW()
   * *
   * Load a VIEW File
   */
  public function view($view,$data = []) {
    extract($data);

    $filename = __DIR__ . '/../views/' . strtolower($view) . '.view.php';
    if (file_exists($filename)) {
      # ...| TRUE Block
      require $filename;
    } else {
      # ...| FALSE Block
      echo "Error! Could not find view file: " . $filename;
    }
    # ---| ./IF?ELSE
  }
  # ---| ./VIEW()
}
# -----|  ./CONTROLLER()
