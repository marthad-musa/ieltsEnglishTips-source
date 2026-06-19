<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
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

    $filename = "../app/views/".strtolower($view).".view.php";
    if (file_exists($filename)) {
      # ...| TRUE Block
      require $filename;
    } else {
      # ...| FALSE Block
      echo "Error! Could not find view file: ". $filename;
    }
    # ---| ./IF?ELSE
  }
  # ---| ./VIEW()
}
# -----|  ./CONTROLLER()
