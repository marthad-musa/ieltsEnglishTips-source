<?php
  use \Model\Auth;
  $uid = get_uid(Auth::getID());
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- ----- Meta data here ----- -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- --| ./Meta data here\. |-- -->

    <!-- ----- Title here ----- -->
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <!-- --| ./Title here\. |-- -->
    
    <!-- ----- Site Information ----- -->
    <meta name="description" content="<?=APP_DESC?>">
    <meta content="" name="keywords">
    <!-- --| ./Site Information\. |-- -->
    
    <!-- ----- Site Author ----- -->
    <meta name="author" content="<?=AUTHOR?>">
    <!-- --| ./Site Author\. |-- -->
    
    <!-- ----- Site Generator ----- -->
    <meta name="generator" content="<?=GENERATOR?>">
    <!-- --| ./Site Generator\. |-- -->
    
    <!-- ----- Favicon here ----- -->
    <link href="<?=ROOT?>/<?=FAVICON?>" rel="icon" type="image/png" />
    <link href="<?=ROOT?>/<?=FAVICON?>" rel="apple-touch-icon" type="image/png" />
    <!-- --| ./Favicon here\. |-- -->
    
    <!-- ----- Google FONTS ----- -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- --| ./Google FONTS\. |-- -->
    
    <!-- ----- FONTS ----- -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/myFont.css" />
    <!-- --| ./FONTS\. |-- -->

    <!-- ----- FONT AWESOME ----- -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/all.min.css" />
    <!-- --| ./FONT AWESOME\. |-- -->

    <!-- ----- Vendor CSS Files ----- -->
    <link href="<?=ROOT?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- --| ./Vendor CSS Files\. |-- -->

    <!-- ----- Main CSS File ----- -->
    <link href="<?=ROOT?>/assets/css/style.css" rel="stylesheet">
    <!-- --| ./Main CSS File\. |-- -->
  </head>

  <body>
