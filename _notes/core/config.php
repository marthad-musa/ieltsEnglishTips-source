<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * ---------
 * CONSTANTS
 * ---------
 */   
# Directory Separator  ---------------
define('DS', DIRECTORY_SEPARATOR);
# ------------|  ./Directory Separator

# Root Path  ---------------
define('ROOTPATH', __DIR__ . DS);
# ------------|  ./Root Path

# Application Name  ---------------
define("APPNAME", "IELTS English Tips");
# ------------|  ./Application Name

# Application Description  ---------------
define("APP_DESC", "IELTS PreparationOnline Educational Academy");
# ------------|  ./Application Description

# Application Information  ---------------
define('AUTHOR', 'Marthad Musa');
define('GENERATOR', 'v1.0');
# ------------|  ./Application Information

# ABSolute PATH  ---------------
define('ABSPATH', true);
# ------------|  ./ABSolute PATH

/**
 * ----------------------
 * DEBUGGER
 * *
 * TRUE means SHOW ERRORS
 * ----------------------
 */
define('DEBUG', true);
# ------------|  ./CONSTANTS

/**
 * DATABASE Configuration
 * *
 */
if ($_SERVER['SERVER_NAME'] == 'localhost') {

  /**
   * --------------------
   * LOCAL Configurations
   * --------------------
   */

  # DATABASE HOST  ---------------
  define('DBHOST', 'localhost');
  # ------------|  ./DATABASE HOST

  # DATABASE NAME  ---------------
  define('DBNAME', 'ieltsenglishtips_db');
  # ------------|  ./DATABASE NAME
  
  # DATABASE USERNAME  ---------------
  define('DBUSER', 'root');
  # ------------|  ./DATABASE USERNAME

  # DATABASE PASSWORD  ---------------
  define('DBPASS', '');
  # ------------|  ./DATABASE PASSWORD

  # DATABASE DRIVER  ---------------
  define('DBDRIVER', 'mysql');
  # ------------|  ./DATABASE DRIVER

  # Full ROOT URL for LOCAL Hosting  ---------------
  /**
   * ----------------------------------
   * define('ROOT', ROOTPATH.'public');
   * ----------------------------------
   */
  define('ROOT', 'http://localhost/ieltsenglishtips/public_html/');
  # ------------|  ./Full ROOT URL for LOCAL Hosting

} else {

  /**
   * ---------------------
   * ONLINE Configurations
   * ---------------------
   */

  # DATABASE HOST  ---------------
  define('DBHOST', 'localhost');
  # ------------|  ./DATABASE HOST

  # DATABASE NAME  ---------------
  define('DBNAME', 'u844991845_ieltsenglish');
  # ------------|  ./DATABASE NAME

  # DATABASE USERNAME  ---------------
  define('DBUSER', 'u844991845_mohammedabbo52');
  # ------------|  ./DATABASE USERNAME

  # DATABASE PASSWORD  ---------------
  define('DBPASS', 'Mo2@011152');
  # ------------|  ./DATABASE PASSWORD

  # DATABASE DRIVER  ---------------
  define('DBDRIVER', 'mysql');
  # ------------|  ./DATABASE DRIVER

  # Full ROOT URL for LOCAL Hosting  ---------------
  /**
   * ----------------------------------
   * define('ROOT', ROOTPATH.'public');
   * ----------------------------------
   */
  define('ROOT', 'https://www.ieltsenglishtips.com');
  # ------------|  ./Full ROOT URL for LOCAL Hosting

}
# ---| ./IF/ELSE