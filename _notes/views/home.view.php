<?php $this->view('partials/header', $data) ?>
<?php $this->view('partials/navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">

    <img src="<?=ROOT?>/assets/img/home-hero.png" alt="" data-aos="fade-in">

    <div class="container">
      <h2 data-aos="fade-up" data-aos-delay="100">Your Path to IELTS Success<br>Starts Here</h2>
      <p class="col-md-8" data-aos="fade-up" data-aos-delay="200">Join thousands of students who achieved their target scores.</p>
      <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="courses.html" class="btn-get-started">Get Started</a>
      </div>
    </div>

  </section>
  <!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="<?=ROOT?>/assets/img/home-about.png" class="img-fluid" alt="home-room" style="border-radius: 25px;">
        </div>

        <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
          <h3>Unlock Your IELTS Potential with Expert Guidance</h3>
          <p class="fst-italic">
            Achieve your desired IELTS score with our comprehensive courses and personalized support. We offer:
          </p>
          <ul>
            <li><i class="bi bi-check-circle"></i> <span>Expert-led Preparation Courses.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Proven Strategies.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Extensive Resources.</span></li>
          </ul>
          <p class="">
            Join thousands of students who achieved their target scores.
          </p>
          <a href="signup.html" class="read-more"><span>Register now!</span><i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </div>

  </section>
  <!-- /About Section -->

  <!-- Why Us Section -->
  <section id="why-us" class="section why-us light-background">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-box">
            <img src="<?=ROOT?>/assets/img/favico.png" alt="Logo" class="w-25">
            <h3>Why Choose<br>
              <i class="fs-4">&nbsp;<q>
                <span><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></span>
              </q>&nbsp;&quest;</i>
            </h3>
            <p class="text-center">My courses are designed by an experienced instructor and tailored to meet every individual needs.</p>
            <div class="text-center">
              <a href="instructor.html" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </div><!-- End Why Box -->

        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

            <div class="col-xl-4">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-mortarboard"></i>
                <h4>Expert Instructor</h4>
                <p>Learn from certified IELTS instructors with years of experience.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-book"></i>
                <h4>Comprehensive Curriculum</h4>
                <p>Cover all aspects of the IELTS exam with our structured and detailed curriculum.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-people"></i>
                <h4>Personalized Support</h4>
                <p>Receive personalized feedback and guidance to improve your performance.</p>
              </div>
            </div><!-- End Icon Box -->

          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /Why Us Section -->

  <!-- Courses Section -->
  <section id="courses" class="courses section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Checkout</h2>
      <p>Other Popular Courses</p>
    </div>
    <!-- End Section Title -->

    <div class="container">

      <div class="row">

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="course-item">
            <img src="<?=ROOT?>/assets/img/course-1.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">IELTS Preparation</p>
                <p class="price">1000 <sup>EGP</sup></p>
              </div>

              <h3><a href="#">IELTS Intensive Course</a></h3>
              <p class="description">Boost your score quickly with our intensive preparation course.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <div class="trainer-profile d-flex align-items-center">
                  <img src="<?=ROOT?>/assets/img/logo.png" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Antonio</a>
                </div>
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
            <img src="<?=ROOT?>/assets/img/course-2.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">English Course</p>
                <p class="price">750 <sup>EGP</sup></p>
              </div>

              <h3><a href="#">Headway Curriculum</a></h3>
              <p class="description">Get ready for journey in learining the English language.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <div class="trainer-profile d-flex align-items-center">
                  <img src="<?=ROOT?>/assets/img/logo.png" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Lana</a>
                </div>
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
            <img src="<?=ROOT?>/assets/img/course-3.png" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="category">I.T</p>
                <p class="price">750 <sup>EGP</sup></p>
              </div>

              <h3><a href="#">Computer Science</a></h3>
              <p class="description">Learn how devices work and connect with the rest of the world.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <div class="trainer-profile d-flex align-items-center">
                  <img src="<?=ROOT?>/assets/img/logo.png" class="img-fluid" alt="">
                  <a href="" class="trainer-link">Brandon</a>
                </div>
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

  <!-- Call to Action -->
  <section data-aos="fade-up" data-aos-delay="100" class="hero section light-background">
    <div class="container text-center">
      <h2 data-aos="fade-up" data-aos-delay="100">Ready to Start Your IELTS Journey&quest;</h2>
      <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="<?=ROOT?>/courses" class="btn btn-primary rounded-pill">Enrole Now</a>
      </div>
    </div>
  </section>
  <!-- /Call to Action -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/footer',$data) ?>