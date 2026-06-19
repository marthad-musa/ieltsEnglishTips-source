<?php

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


# AutoLoader()  ---------------
spl_autoload_register(
  function ($class_name) {
    $parts = explode("\\", $class_name);
    $base = array_pop($parts);

    $paths = [
      __DIR__ . '/' . strtolower($base) . '.php',
      __DIR__ . '/' . $base . '.php',
      __DIR__ . '/../models/' . $base . '.php',
      __DIR__ . '/../models/' . strtolower($base) . '.php',
    ];

    foreach ($paths as $file) {
      if (file_exists($file)) {
        require_once $file;
        return;
      }
    }

    // fallback - original behavior (may raise error)
    $file = __DIR__ . '/../models/' . $base . '.php';
    require_once $file;
  }
  # ---| ./Anonymous Function
);
# ------------|  ./AutoLoader()

# Core Files REQUIRED  ---------------
require "../app/core/config.php";
require "../app/core/functions.php";
require "../app/core/database.php";
require "../app/core/model.php";
require "../app/core/controller.php";
require "../app/core/app.php";
# ------------|  ./Core Files REQUIRED

