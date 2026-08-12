<!-- ---------| HEADER |--------- -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?=ROOT?>" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block"><span style="color: crimson;">IELTS</span> <span style="color: #5578ff;">English</span> <span style="color: orangered;">Tips</span></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>
  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?=get_image($uid->image)?>" alt="<?=esc($uid->firstname . ' ' . $uid->lastname)?> Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?=ucfirst($uid->firstname . ' ' . $uid->lastname)?></span>
        </a>
        <!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?=ucfirst($uid->firstname . ' ' . $uid->lastname)?></h6>
            <span><?=ucfirst(esc($uid->job)) ?: 'CEO & Founder'?></span> | <span class="text-primary"><?=ucfirst(esc($uid->role_name))?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>/admin/profile">
              <!-- <i class="bi bi-person"></i> -->
              <i class="ri-user-settings-line"></i>
              <span>My Profile and Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>/logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul>
        <!-- End Profile Dropdown Items -->

      </li>
      <!-- End Profile Nav -->

    </ul>
  </nav>
  <!-- End Icons Navigation -->

</header>
<!-- -------| ./HEADER\. |------- -->

<!-- ---------| SideNav |--------- -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- ---------| This should be limited to Admin |--------- -->
    <?php // if(user_can('view_dashboard')):?>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/admin/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
    <?php // endif;?>
    <!-- End Dashboard Page Nav -->

    <!-- ---------| This should be PUBLIC |--------- -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT?>/admin/profile">
        <i class="bi bi-person-badge"></i>
        <span>Profile</span>
      </a>
    </li>  
    <!-- End PROFILE Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bx bx-book"></i><span>COURSES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

        <!-- ---------- |This should be limited to Admins & Teachers| ---------- -->
        <?php // if(user_can('view_my_courses')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/courses">
              <i class="bi bi-mortarboard fs-6"></i>
              <span>My Courses</span>
            </a>
          </li>
        <?php // endif;?>
        <!-- End MY COURSES Page Nav -->
        
        <!-- ---------- |This should be limited to Studens/User| ---------- -->
        <?php // if(user_can('view_enrolled')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/lessons">
              <i class="bi bi-person-video3 fs-6"></i>
              <span>Enrolled Courses</span>
            </a>
          </li>
        <?php // endif;?>
        <!-- End ENROLLED COURSES Page Nav -->

        <!-- ---------- |This should be limited to Admin| ---------- -->
        <?php // if(user_can('view_ategories')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/categories">
              <i class="bi bi-card-list fs-6"></i>
              <span>Categories</span>
            </a>
          </li>
        <?php // endif;?>
        <!-- End CATEGORIES Page Nav -->

        <!-- ---------- |This should be limited to Instructors| ---------- -->
        <?php // if(user_can('view_material')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/lectures">
              <i class="bi bi-camera-reels fs-6"></i>
              <span>Lectures Materials</span>
            </a>
          </li>
        <?php // endif;?>
        <!-- End LECTURES MATERIALS Page Nav -->
          
        <!-- ---------- |This should be limited to Instructors| ---------- -->
        <?php // if(user_can('view_quiz')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/exams">
              <i class="fa fa-circle-question fs-6"></i>
              <span>Quizzes</span>
            </a>
          </li>
        <?php // endif;?>
        <!-- End QUIZZES Page Nav -->
          
        <!-- ---------- |This should be limited to Instructors| ---------- -->
        <?php // if(user_can('view_final_score')):?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-trophy fs-6"></i>
              <span>Final Scores</span>
            </a>
          </li>
        <?php // endif; ?>
        <!-- End FINAL SCORES Page Nav -->
      </ul>
      <!-- -------| ./COURSES\. |------- -->
    </li>  
    <!-- End COURSES Pages Nav -->
    
    <!-- ---------- |This should be limited to Admin| ---------- -->
    <?php // if(user_can('view_users')):?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>USERS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <?php // if(user_can('view_admins')):?>
            <li>
              <a href="<?=ROOT?>/admin/users" class="nav-link">
                <i class="fa fa-users fs-6"></i> <span>Users</span>
              </a>
            </li>
          <?php // endif;?>
          <!-- End ADMINISTRATION Page Nav -->
          <?php // if(user_can('view_roles')):?>
            <li>
              <a href="<?=ROOT?>/admin/roles" class="nav-link">
                <i class="bi bi-journal-richtext fs-6"></i> <span>User Roles &amp; Permissions</span>
              </a>
            </li>
          <?php // endif;?>
          <!-- End STUDENTS Page Nav -->
        </ul>
      </li>
      <!-- End USER Pages Nav -->
    <?php // endif;?>

    <?php // if(user_can('edit_slider_images')):?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/slider-images">
          <i class="bi bi-images"></i>
          <span>Slider Images</span>
        </a>
      </li>  
    <?php // endif; ?>
    <!-- End SLIDER Page Nav -->

    <li class="nav-heading">Go to</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT?>">
        <i class="fa fa-house"></i>
        <span>Home</span>
      </a>
    </li>
    <!-- End HOME Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?=ROOT?>/logout">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
      </a>
    </li>
    <!-- End Login Page Nav -->

    <li class="nav-item">
      <img src="<?=ROOT?>/assets/img/brand.png" alt="" class="w-75 ms-4">
    </li>

  </ul>

</aside>
<!-- -------| ./SideNav\. |------- -->
