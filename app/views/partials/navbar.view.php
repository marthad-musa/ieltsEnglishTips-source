<?php
  use \Model\Auth;
  $uid = get_uid(Auth::getID());
?>

<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="<?=ROOT?>/" class="logo d-flex align-items-center me-auto">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <img src="assets/img/favico.png" alt="Logo" style="max-width: 30%;">
      <h1 class="sitename fs-6">
        <span class="fs-4 ms-1" style="letter-spacing: 2px;"><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></span>
        <br>
        <small style="font-size: 10px; letter-spacing: 1px;">Learn English in a simple&comma; calm <span style="color: crimson;">&AMP;</span> friendly way</small>
      </h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="<?=ROOT?>/" class="active">Home<br></a></li>
        <li><a href="<?=ROOT?>/about">About</a></li>
        <li><a href="<?=ROOT?>/courses">Courses</a></li>
        <li><a href="<?=ROOT?>/faculty">Faculty</a></li>
        <li><a href="<?=ROOT?>/blog">Announcement</a></li>
        <li><a href="<?=ROOT?>/contact">Contact</a></li>
        <?php if (Auth::logged_in()) : ?>
          <li class="dropdown"><a href="#"><span>Hi&comma;&nbsp;<?=esc($uid->firstname)?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">My Courses</a></li>
              <li><a href="#">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="<?=ROOT?>/login">Login</a></li>
        <?php endif; ?>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>


  </div>
</header>
