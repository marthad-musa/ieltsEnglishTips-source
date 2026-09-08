<?php
  use \Model\Auth;
  $uid = get_uid(Auth::getID());
  // $no_nav[] = ["login", "signup"];
?>

<!-- ------------- HEADER ------------- -->
<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="<?=ROOT?>" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">
        <span style="letter-spacing: 6px; color: crimson;">IELTS</span> <span style="letter-spacing: 6px;">English</span> <span style="letter-spacing: 6px; color: orangered;">Tips</span>
        <br>
        <small style="font-size: 13px; letter-spacing: 1px;">Learn English in a simple&comma; calm <span style="color: crimson;">&AMP;</span> friendly way</small>
      </h1>
    </a>

    <nav id="navmenu" class="navmenu me-auto">
      <ul>
        <li><a href="<?=ROOT?>" class="<?=active_nav('home')?? ''?>">Home<br></a></li>
        <li><a href="<?=ROOT?>/about" class="<?=active_nav('about')?? ''?>">About</a></li>
        <li><a href="<?=ROOT?>/courses" class="<?=active_nav('courses')?? ''?>">Courses</a></li>
        <li><a href="<?=ROOT?>/faculty" class="<?=active_nav('faculty')?? ''?>">Faculty</a></li>
        <!-- <li><a href="<?=ROOT?>/events" class="<?=active_nav('events')?? ''?>">Events</a></li> -->
        <li><a href="<?=ROOT?>/contact" class="<?=active_nav('contact')?? ''?>">Contact</a></li>
        <?php if(!Auth::logged_in()):?>
          <li><a href="<?=ROOT?>/login">Login</a></li>
        <?php else:?>
          <!-- ---- USER_DATA ---- -->
          <li class="dropdown"><a href="#"><span>Hi, <?=esc($uid->firstname)?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
              <li><a href="<?=ROOT?>/admin/profile">Profile</a></li>
              <!-- <li><a href="#">Settings</a></li> -->
              <li><a href="<?=ROOT?>/logout">Logout</a></li>
            </ul>
          </li>
          <!-- -| ./USER_DATA\. |- -->
        <?php endif;?>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <!-- <a class="btn-getstarted" href="courses">Get Started</a> -->

  </div>
</header>
<!-- ----------| ./HEADER\. |---------- -->
