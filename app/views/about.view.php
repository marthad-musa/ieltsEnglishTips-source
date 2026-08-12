<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-9.png" alt="" data-aos="fade-in" class="opacity-75">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">About Us</h2>
        <p data-aos="fade-up" data-aos-delay="200" class="text-white">
          At <i><q><strong><span style="color: crimson;">IELTS</span> <span style="color: #5578ff;">English</span> <span style="color: orangered;">Tips</span></strong></q></i>&comma; we are dedicated
          <br>to help students achieve their desired
          <br>IELTS scores through comprehensive and
          <br>personalized training programs.
        </p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="<?=ROOT?>/courses" class="btn-get-started">Get Started</a>
        </div>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">About Us<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- ---------| About Us Section |--------- -->
  <section id="about" class="about section">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="<?=ROOT?>/assets/img/slide-2.jpg" class="img-fluid" alt="home-room" style="border-radius: 25px;">
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
          <a href="<?=ROOT?>/signup" class="read-more"><span>Register now!</span><i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </div>

  </section>
  <!-- -------| ./About Us Section\. |------- -->

  <!-- ---------| Counts Section |--------- -->
  <section id="counts" class="section counts light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Students</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
            <p>Courses</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
            <p>Events</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
            <p>Teachers</p>
          </div>
        </div><!-- End Stats Item -->

      </div>

    </div>

  </section>
  <!-- -------| ./Counts Section\. |------- -->

  <!-- Call to Action -->
  <section data-aos="fade-up" data-aos-delay="100" class="hero section">
    <div class="container text-center">
      <p data-aos="fade-up" data-aos-delay="100" class="mb-3">
        Our experienced instructors and proven methodologies
        <br>ensure that you'll recieve the best possible
        <br>preparation for your IELTS exam.
      </p>
      <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="<?=ROOT?>/courses" class="btn btn-lg btn-primary rounded-pill">Enrole Now</a>
      </div>
    </div>
  </section>
  <!-- /Call to Action -->
</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>