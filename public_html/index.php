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
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

# REQUIREMENTS  ---------------
session_start();
require "../app/core/init.php";
# ------------|  ./REQUIREMENTS
# -----| Instantiating the Class | -----
$app = new App();
# ---| ./Instantiating the Class\. | ---