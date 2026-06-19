<?php
  use \Model\Auth;
  $uid = get_uid(Auth::getID());
?>


<!DOCTYPE html>
<!-- <html lang="ar" dir="rtl" data-bs-theme="auto"> -->
<html lang="en">
  <head>
    <!-- ----- Bootstrap Color Modes ----- -->
    <!-- <script src="<?=ROOT?>//assets/js/color-modes.js"></script> -->
    <!-- --| ./Bootstrap Color Modes\. |-- -->

    <!-- ----- Meta data here ----- -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- --| ./Meta data here\. |-- -->

    <!-- ----- Title here ----- -->
    <title>Dashboard &dash; <?=APP_NAME?></title>
    <!-- --| ./Title here\. |-- -->
    
    <!-- ----- Site Information ----- -->
    <meta name="description" content="<?=APP_DESC?>">
    <meta name="keywords" content="">
    <!-- --| ./Site Information\. |-- -->
    
    <!-- ----- Site Author ----- -->
    <meta name="author" content="<?=AUTHOR?>">
    <!-- --| ./Site Author\. |-- -->
    
    <!-- ----- Site Generator ----- -->
    <meta name="generator" content="<?=GENERATOR?>">
    <!-- --| ./Site Generator\. |-- -->
    
    <!-- ----- Favicon here ----- -->
    <!-- <link rel="icon" href="<?=ROOT?>//<?=FAVICO?>" type="image/x-icon" /> -->
    <link rel="icon" href="<?=ROOT?>//<?=FAVICON?>" type="image/png" />
    <!-- <link rel="icon" href="<?=ROOT?>//<?=LOGO?>" type="image/png" /> -->
    <!-- --| ./Favicon here\. |-- -->
    
    <!-- ----- FONTS ----- -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?=ROOT?>//assets/css/myFont.css" />
    <!-- --| ./FONTS\. |-- -->

    <!-- ---- FONTAWESOME ---- -->
    <link rel="stylesheet" href="<?=ROOT?>//assets/css/all.min.css" />
    <!-- -| ./FONTAWESOME\. |- -->

    <!-- ----- CSS STYLE ----- -->
    <link href="<?=ROOT?>//niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=ROOT?>//zenblog/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?=ROOT?>//niceadmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?=ROOT?>//niceadmin/assets/css/style.css" rel="stylesheet">
    <link href="<?=ROOT?>//assets/css/custom.css" rel="stylesheet">
    <!-- --| ./CSS STYLE\. |-- -->

    <!-- jQUERY File -->
    <!-- <script src="<?=ROOT?>//assets/js/jquery-3.7.1.min.js"></script> -->

    <!-- ---- HEADER Scripts ---- -->
    <script src="<?=ROOT?>//assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?=ROOT?>//assets/style/parsley.js"></script>
    <script src="<?=ROOT?>//assets/js/popper.min.js"></script>
    <script src="<?=ROOT?>//assets/style/jquery.dataTables.min.js"></script>
    <script src="<?=ROOT?>//assets/style/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="<?=ROOT?>//assets/style/TimeCircles.css" />
    <script src="<?=ROOT?>//assets/style/TimeCircles.js"></script>
    <!-- -| ./HEADER Scripts\. |- -->

    <!-- ==========================================
    * Template Name: Erudite - v1.0.0
    * Template URL: https://bootstrapmade.com/
    * Author: Marthad
    * License: https:///bootstrapmade.com/license/
    =========================================== -->
  </head>

  <body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="<?=ROOT?>//<?=FAVICON?>" alt="<?=APPNAME?>">
          <span class="d-none d-lg-block fontLucindaH" title="<?=APPNAME?>"><?=APP_NAME?></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <!-- <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div> -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

          <!-- <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li> -->
          <!-- End Search Icon-->

          <!-- <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-bell"></i>
              <span class="badge bg-primary badge-number">4</span>
            </a> -->
            <!-- End Notification Icon -->

            <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
              <li class="dropdown-header">
                You have 4 new notifications
                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>Lorem Ipsum</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>30 min. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-x-circle text-danger"></i>
                <div>
                  <h4>Atque rerum nesciunt</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>1 hr. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-check-circle text-success"></i>
                <div>
                  <h4>Sit rerum fuga</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>2 hrs. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                  <h4>Dicta reprehenderit</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>4 hrs. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="dropdown-footer">
                <a href="#">Show all notifications</a>
              </li>

            </ul> -->
            <!-- End Notification Dropdown Items -->

          <!-- </li> -->
          <!-- End Notification Nav -->

          <!-- <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-chat-left-text"></i>
              <span class="badge bg-success badge-number">3</span>
            </a> -->
            <!-- End Messages Icon -->

            <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
              <li class="dropdown-header">
                You have 3 new messages
                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="message-item">
                <a href="#">
                  <img src="<?=ROOT?>//niceadmin/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                  <div>
                    <h4>Maria Hudson</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>4 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="message-item">
                <a href="#">
                  <img src="<?=ROOT?>//niceadmin/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                  <div>
                    <h4>Anna Nelson</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>6 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="message-item">
                <a href="#">
                  <img src="<?=ROOT?>//niceadmin/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                  <div>
                    <h4>David Muldon</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>8 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="dropdown-footer">
                <a href="#">Show all messages</a>
              </li>

            </ul> -->
            <!-- End Messages Dropdown Items -->

          <!-- </li> -->
          <!-- End Messages Nav -->

          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="<?=get_image($uid->image)?>" alt="Profile" class="rounded-circle" style="width:38px;max-width:38px;height:38px;object-fit:cover;">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?=ucfirst(substr($uid->firstname,0,1))?>. <?=ucfirst($uid->lastname)?></span>
            </a>
            <!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?=ucfirst($uid->firstname)?> <?=ucfirst($uid->lastname)?></h6>
                <!-- <span class="fw-bold"><?=ucfirst($row->role_name)?></span> -->
                <span class="fw-bold"><?=ucfirst($uid->role_name)?></span>
                <!-- ---- Language Control ---- -->
                <span class="btn btn-outline-primary"><?=ucfirst($uid->language)?></span>
                <!-- -| ./Language Control\. |- -->
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>//admin/profile">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <!-- <li>
                <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>//admin/profile">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li> -->

              <!-- <li>
                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>Need Help?</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li> -->

              <li>
                <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>//logout">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <!-- ---------| This should be limited to Admin |--------- -->
        <?php if(user_can('view_dashboard')):?>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>//admin/dashboard">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li>
        <?php endif;?>
        <!-- End Dashboard Page Nav -->

        <!-- ---------| This should be PUBLIC |--------- -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=ROOT?>//admin/profile">
            <i class="bi bi-person-badge"></i>
            <span>Profile</span>
          </a>
        </li>  
        <!-- End PROFILE Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="fa fa-book"></i><span>COURSES</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

            <!-- ---------- |This should be limited to Instructors| ---------- -->
            <?php if(user_can('view_my_courses')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/courses">
                  <i class="bi bi-mortarboard fs-6"></i>
                  <span>My Courses</span>
                </a>
              </li>
            <?php endif;?>
            <!-- End MY COURSES Page Nav -->
            
            <!-- ---------- |This should be limited to Studens/User| ---------- -->
            <?php if(user_can('view_enrolled')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/lessons">
                  <i class="bi bi-person-video3 fs-6"></i>
                  <span>Enrolled Courses</span>
                </a>
              </li>
            <?php endif;?>
            <!-- End ENROLLED COURSES Page Nav -->

            <!-- ---------- |This should be limited to Studens/User| ---------- -->
            <!-- <?php if(user_can('view_history')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/lessons">
                  <i class="bi bi-hourglass-split fs-6"></i>
                  <span>Watched History</span>
                </a>
              </li>
            <?php endif;?> -->
            <!-- End WATCHED HISTORY Page Nav -->

            <!-- ---------- |This should be limited to Admin| ---------- -->
            <?php if(user_can('view_ategories')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/categories">
                  <i class="bi bi-card-list fs-6"></i>
                  <span>Categories</span>
                </a>
              </li>
            <?php endif;?>
            <!-- End CATEGORIES Page Nav -->

            <!-- ---------- |This should be limited to Instructors| ---------- -->
            <?php if(user_can('view_material')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/">
                  <i class="bi bi-camera-reels fs-6"></i>
                  <span>Lectures Materials</span>
                </a>
              </li>
            <?php endif;?>
            <!-- End LECTURES MATERIALS Page Nav -->
              
            <!-- ---------- |This should be limited to Instructors| ---------- -->
            <?php if(user_can('view_quiz')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?=ROOT?>//admin/exams">
                  <i class="fa fa-circle-question fs-6"></i>
                  <span>Quizzes</span>
                </a>
              </li>
            <?php endif;?>
            <!-- End QUIZZES Page Nav -->
              
            <!-- ---------- |This should be limited to Instructors| ---------- -->
            <?php if(user_can('view_final_score')):?>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fa fa-trophy fs-6"></i>
                  <span>Final Scores</span>
                </a>
              </li>
            <?php endif; ?>
            <!-- End FINAL SCORES Page Nav -->
          </ul>
          <!-- -------| ./COURSES\. |------- -->
        </li>  
        <!-- End COURSES Pages Nav -->
        
        <!-- ---------- |This should be limited to Admin| ---------- -->
        <?php if(user_can('view_users')):?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-people"></i><span>USERS</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <?php if(user_can('view_admins')):?>
                <li>
                  <a href="#" class="nav-link">
                    <i class="fa fa-user-tie fs-6"></i> <span>Administration</span>
                  </a>
                </li>
              <?php endif;?>
              <!-- End ADMINISTRATION Page Nav -->
              <?php if(user_can('view_instructor')):?>
                <li>
                  <a href="#" class="nav-link">
                    <i class="fa fa-graduation-cap fs-6"></i> <span>Instructors</span>
                  </a>
                </li>
              <?php endif;?>
              <!-- End TEACHERS Page Nav -->
              <?php if(user_can('view_student')):?>
                <li>
                  <a href="#" class="nav-link">
                    <i class="fa fa-users fs-6"></i> <span>Students</span>
                  </a>
                </li>
              <?php endif;?>
              <!-- End STUDENTS Page Nav -->
              <?php if(user_can('view_roles')):?>
                <li>
                  <a href="<?=ROOT?>//admin/roles" class="nav-link">
                    <i class="bi bi-journal-richtext fs-6"></i> <span>User Roles &amp; Permissions</span>
                  </a>
                </li>
              <?php endif;?>
              <!-- End STUDENTS Page Nav -->
            </ul>
          </li>
          <!-- End USER Pages Nav -->
        <?php endif;?>

        <?php //if(Auth::is_admin()): ?>
        <?php if(user_can('edit_slider_images')):?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="<?=ROOT?>//admin/slider-images">
              <i class="bi bi-images"></i>
              <span>Slider Images</span>
            </a>
          </li>  
        <?php endif; ?>
        <!-- End SLIDER Page Nav -->

        <li class="nav-heading">Go to</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=ROOT?>/">
            <i class="fa fa-house"></i>
            <span>Home</span>
          </a>
        </li>
        <!-- End HOME Page Nav -->

        <!-- <?php if(user_can('view_sales')):?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#finance-nav" data-bs-toggle="collapse" href="#">
              <i class="fa fa-chart-line"></i><span>FINANCE</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="finance-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <?php if(user_can('view_receipt')):?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=ROOT?>//admin/sales">
                    <i class="bi bi-cash-coin fs-6"></i>
                    <span>Payment Receipts</span>
                  </a>
                </li>
              <?php endif;?> -->
              <!-- End PAYMENT RECEIPTS Page Nav -->

              <!-- <?php if(user_can('view_income')):?>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="bi bi-currency-exchange fs-6"></i>
                    <span>Annual Income</span>
                  </a>
                </li>
              <?php endif;?> -->
              <!-- End ANNUAL INCOME Page Nav -->

            <!-- </ul>  
          </li>   -->
          <!-- End COURSES Pages Nav -->
        <!-- <?php endif;?> -->

        <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="#">
            <i class="fa fa-lightbulb fs-6"></i>
            <span>Announcement</span>
          </a>
        </li> -->
        <!-- End ANNOUNCEMENT Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=ROOT?>//logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
          </a>
        </li>
        <!-- End Login Page Nav -->
      </ul>

    </aside>
    <!-- End Sidebar-->

    <!-- ---- MAIN ---- -->
    <main id="main" class="main">
