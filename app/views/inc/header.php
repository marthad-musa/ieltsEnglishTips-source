<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo SITENAME; ?> | <?php echo $data['title']; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?php echo URLROOT; ?>/assets/img/favico.png" rel="icon">
    <link href="<?php echo URLROOT; ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo URLROOT; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo URLROOT; ?>/assets/css/main.css" rel="stylesheet">
  </head>

  <body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="<?php echo URLROOT; ?>" class="logo d-flex align-items-center me-auto">
          <img src="<?php echo URLROOT; ?>/assets/img/favico.png" alt="Logo" class="">
          <h1 class="sitename fs-6">
            <span class="fs-4 ms-1" style="letter-spacing: 2px;"><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></span>
            <br>
            <small style="font-size: 10px; letter-spacing: 1px;">Learn English in a simple&comma; calm <span style="color: crimson;">&AMP;</span> friendly way</small>
          </h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="<?php echo URLROOT; ?>" class="<?php echo ($data['title'] == 'IELTS English Tips') ? 'active' : ''; ?>">Home<br></a></li>
            <li><a href="<?php echo URLROOT; ?>/pages/about" class="<?php echo ($data['title'] == 'About Us') ? 'active' : ''; ?>">About</a></li>
            <li><a href="<?php echo URLROOT; ?>/courses" class="<?php echo ($data['title'] == 'Courses') ? 'active' : ''; ?>">Courses</a></li>
            <li><a href="<?php echo URLROOT; ?>/faculty" class="<?php echo ($data['title'] == 'Faculty') ? 'active' : ''; ?>">Faculty</a></li>
            <li><a href="<?php echo URLROOT; ?>/announcements" class="<?php echo ($data['title'] == 'Announcement') ? 'active' : ''; ?>">Announcement</a></li>
            <li><a href="<?php echo URLROOT; ?>/pages/contact" class="<?php echo ($data['title'] == 'Contact Us') ? 'active' : ''; ?>">Contact</a></li>
            <?php if(isset($_SESSION['user_id'])) : ?>
                <li class="dropdown"><a href="#"><span>Dashboard</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="<?php echo URLROOT; ?>/users/profile">Profile</a></li>
                        <li><a href="<?php echo URLROOT; ?>/dashboard">Control Panel</a></li>
                        <li><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="<?php echo URLROOT; ?>/users/login">Login</a></li>
            <?php endif; ?>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="<?php echo URLROOT; ?>/courses">Get Started</a>

      </div>
    </header>
