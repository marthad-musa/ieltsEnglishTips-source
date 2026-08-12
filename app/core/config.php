<?php

/**
 * User: TECH-Tag
 * Date: 11/01/2025
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://marthadmusa.blogger.com
 */

/**
 * -------------
 * | CONSTANTS |
 * -------------
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
define("APP_DESC", "Online Educational Academy");
# ------------|  ./Application Description

# Application Information  ---------------
define('AUTHOR', 'Marthād Musa');
define('WEBSITE', 'https://www.linkedin.com/in/marthad-musa-78389039/');
define('GENERATOR', 'v1.0');
define('APPYEAR', date('Y'));
# ------------|  ./Application Information

# Application SuperUser  ---------------
define('ROOTUSER', 'marthad');
define('UID', 'contact@marthad.me');
define('PWD', md5('41m!6hty'));
define('ROLE', 'admin');
define('LAN', 'en');
# ------------|  ./Application SuperUser

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

# IMAGES  ---------------
define('FAVICON', 'assets/img/favico.png');
define('BRAND', 'assets/img/brand.png');
define('LOGO', 'assets/img/logo.png');
define('NOTFOUND', 'assets/img/404.svg');
define('ADMINISTRATOR', 'assets/img/admin.jpg');
define('FEMALE', 'assets/img/female.jpg');
define('MALE', 'assets/img/male.jpg');
define('No_Image', 'assets/img/noimage.jpg');
define('NoIMAGE', 'assets/img/noIMG.jpg');
# ------------|  ./IMAGES

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
  // define('ROOT', 'http://localhost/mentor/public_html');
  define('ROOT', 'http://localhost/ieltsenglishtips/public_html');
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