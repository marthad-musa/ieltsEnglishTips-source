<?php $this->view('partials/header', $data) ?>
<?php $this->view('partials/navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Courses</h1>
            <p class="mb-0 fs-4">Explore our comprehensive courses designed to help you optain your future goals.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>/">Home</a></li>
          <li class="current">Courses</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Courses Section -->
  <section id="courses" class="courses section">

    <div class="container">

      <div class="row">

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="course-item">
            <img src="<?ROOT?>assets/img/course-1.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">IELTS</p>
                <p class="price">1000 EGP</p>
              </div>

              <h3><a href="#">IELTS Intensive Course</a></h3>
              <p class="description">Boost your score quickly with our intensive preparation course.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <!-- <div class="trainer-profile d-flex align-items-center">
                  <img src="<?ROOT?>assets/img/person/person-m-7.webp" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Antonio</a>
                </div> -->
                <div class="trainer-rank d-flex align-items-center">
                  <i class="bi bi-person user-icon"></i>&nbsp;50
                  &nbsp;&nbsp;
                  <i class="bi bi-heart heart-icon"></i>&nbsp;65
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Course Item-->

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="course-item">
            <img src="<?ROOT?>assets/img/course-2.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">English Course</p>
                <p class="price">750 EGP</p>
              </div>

              <h3><a href="#">Headway Curriculum</a></h3>
              <p class="description">Get ready for journey in learining the English language.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <!-- <div class="trainer-profile d-flex align-items-center">
                  <img src="<?ROOT?>assets/img/person/person-f-14.webp" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Lana</a>
                </div> -->
                <div class="trainer-rank d-flex align-items-center">
                  <i class="bi bi-person user-icon"></i>&nbsp;35
                  &nbsp;&nbsp;
                  <i class="bi bi-heart heart-icon"></i>&nbsp;42
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Course Item-->

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
          <div class="course-item">
            <img src="<?ROOT?>assets/img/course-3.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">I.T</p>
                <p class="price">750 EGP</p>
              </div>

              <h3><a href="#">Computer Science</a></h3>
              <p class="description">Learn how devices work and connect with the rest of the world.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <!-- <div class="trainer-profile d-flex align-items-center">
                  <img src="<?ROOT?>assets/img/person/person-m-12.webp" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Brandon</a>
                </div> -->
                <div class="trainer-rank d-flex align-items-center">
                  <i class="bi bi-person user-icon"></i>&nbsp;20
                  &nbsp;&nbsp;
                  <i class="bi bi-heart heart-icon"></i>&nbsp;85
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Course Item-->

      </div>

    </div>

  </section>
  <!-- /Courses Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/footer',$data) ?>