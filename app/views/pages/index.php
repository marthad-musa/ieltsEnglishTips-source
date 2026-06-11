<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">
    <img src="<?php echo URLROOT; ?>/assets/img/home-hero.png" alt="" data-aos="fade-in">
    <div class="container">
      <h2 data-aos="fade-up" data-aos-delay="100"><?php echo $data['title']; ?><br>Starts Here</h2>
      <p class="col-md-8" data-aos="fade-up" data-aos-delay="200"><?php echo $data['description']; ?></p>
      <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="<?php echo URLROOT; ?>/courses" class="btn-get-started">Get Started</a>
      </div>
    </div>
  </section>
  <!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="<?php echo URLROOT; ?>/assets/img/home-about.jpg" class="img-fluid" alt="">
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
          <a href="<?php echo URLROOT; ?>/users/register" class="read-more"><span>Register now!</span><i class="bi bi-arrow-right"></i></a>
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
            <img src="<?php echo URLROOT; ?>/assets/img/favico.png" alt="Logo" class="w-25">
            <h3>Why Choose<br>
              <i class="fs-4">&nbsp;<q>
                <span><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></span>
              </q>&nbsp;&quest;</i>
            </h3>
            <p class="text-center">My courses are designed by an experienced instructor and tailored to meet every individual needs.</p>
            <div class="text-center">
              <a href="<?php echo URLROOT; ?>/pages/about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
            <div class="col-xl-4">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-mortarboard"></i>
                <h4>Expert Instructor</h4>
                <p>Learn from certified IELTS instructors with years of experience.</p>
              </div>
            </div>
            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-book"></i>
                <h4>Comprehensive Curriculum</h4>
                <p>Cover all aspects of the IELTS exam with our structured and detailed curriculum.</p>
              </div>
            </div>
            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-people"></i>
                <h4>Personalized Support</h4>
                <p>Receive personalized feedback and guidance to improve your performance.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Why Us Section -->

</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
