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

# REQUIREMENTS  ---------------
session_start();

$bootstrap = dirname(__DIR__) . '/app/core/init.php';
if (!is_file($bootstrap)) {
  http_response_code(500);
  echo 'Application bootstrap file not found: ' . htmlspecialchars($bootstrap, ENT_QUOTES, 'UTF-8');
  exit;
}

require_once $bootstrap;
# ------------|  ./REQUIREMENTS
# -----| Instantiating the Class | -----
$app = new App();
# ---| ./Instantiating the Class\. | ---