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
            <h1>About Us<br></h1>
            <p class="mb-0">At <i><q><strong><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></strong></q></i>&comma; we are dedicated to help students achieve their desired IELTS scores through comprehensive and personalized training programs. Our experienced instructors and proven methodologies ensure that your recieve the best possible preparation for your IELTS exam.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>/">Home</a></li>
          <li class="current">About Us<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- About Us Section -->
  <section id="about-us" class="section about-us">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="<?=ROOT?>/assets/img/home-about.png" class="img-fluid" alt="home-room" style="border-radius: 25px;">
        </div>

        <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
          <h3>Our History</h3>
          <p class="fst-italic">
            Founded in 2010&comma; <i><q><strong><span style="color: crimson;">IELTS</span> <span style="color: #4f70f1;">English</span> <span style="color: orangered;">Tips</span></strong></q></i> began as a small tutoring center with a big vision&colon; to provide high-quality IELTS training that is accessible and effective for all students. Over the years&comma; we have grown into a leading institution&comma; helping thousands of students from diverse backgrounds achieve their academic and professional goals. Our commitment to excellence and student success remains at the heart of everything we do.
          </p>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <h3>Our Mission</h3>
              <p>To empower students with the knowledge&comma; skills&comma; and confidence needed to excel in the IELTS exam through innovative and supportive learning</p>
            </div>
            <div class="col-sm-12 col-md-6">
              <h3>Our Vision</h3>
              <p>To be the premiere IELTS training institution&comma; recognized for our quality&comma; success&comma; and commitment to student-centric innovation.</p>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /About Us Section -->

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section bg-light">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <p>Why Choose</p>
      <h2 class="fst-italic fw-bold"><q><span style="color: crimson;">IELTS</span> <span style="color: #4f70f1;">English</span> <span style="color: orangered;">Tips</span></q>&quest;</h2>
      <div class="my-3 fs-3 text-center" data-aos="fade-in" data-aos-delay="100">
        We provide a unique blend of expertise&comma; personalized support&comma;<br>and a track record of success to guide you on your IELTS journey.
      </div>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper">
        <div class="swiper-wrapper">

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <span class="testimonial-img text-center text-white shadow py-3" style="background-color: #5578ff;"><i class="bi bi-mortarboard-fill fs-2"></i></span>
              <h3>Experienced Instructors</h3>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Our instructors are highly qualified and experienced in IELTS training&comma; providing expert guidance and support.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <span class="testimonial-img text-center text-white shadow py-3" style="background-color: #5578ff;"><i class="bi bi-people-fill fs-2"></i></span>
              <h3>Personalized Approach</h3>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>We tailor our training programs to meet the individual needs and learning styles of each student.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <span class="testimonial-img text-center text-white shadow py-3" style="background-color: #5578ff;"><i class="bi bi-award-fill fs-2"></i></span>
              <h3>Proven Results</h3>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Our students consistently achieve high IELTS score&comma; demonstrating the effictiveness of our training methods.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div>
          <!-- End testimonial item -->

        </div>
      </div>

    </div>

  </section>
  <!-- /Testimonials Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/footer',$data) ?>