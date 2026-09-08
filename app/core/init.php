<?php

/**
 * User: TECH-Tag
 * Date: 11/01/2025
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://marthadmusa.blogger.com
 */

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


# AutoLoader()  ---------------
spl_autoload_register(
  function ($class_name) {
    $parts = explode("\\", $class_name);
    $class_name = array_pop($parts);

    // require_once "../app/models/".$class_name.".php";
    require_once __DIR__ . '/../models/' . $class_name . '.php';
  }
  # ---| ./Anonymous Function
);
# ------------|  ./AutoLoader()

# Core Files REQUIRED  ---------------
// require "../app/core/config.php";
// require "../app/core/permissions.php";
// require "../app/core/functions.php";
// require "../app/core/database.php";
// require "../app/core/model.php";
// require "../app/core/controller.php";
// require "../app/core/app.php";
require __DIR__ . '/config.php';
require __DIR__ . '/permissions.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/database.php';
require __DIR__ . '/model.php';
require __DIR__ . '/controller.php';
require __DIR__ . '/app.php';
# ------------|  ./Core Files REQUIRED

