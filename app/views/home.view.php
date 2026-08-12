<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------| MAIN |------------ -->
<main class="main">
  
  <!-- ---------| Hero Section |--------- -->
  <?php if (!empty($images)) : ?>
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
      <!-- ---------| Carousel Indicators |--------- -->
      <div class="carousel-indicators">
        <?php for ($i = 0; $i < count($images); $i++): ?>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?=$i?>" class="active" aria-current="true" aria-label="Slide <?=$i+1?>"></button>
        <?php endfor; ?>
      </div>
      <!-- -------| ./Carousel Indicators\. |------- -->

      <!-- ---------| Carousel Sliders |--------- -->
      <div class="carousel-inner">
        <!-- ---------| Carousel |--------- -->
        <?php foreach ($images as $image): ?>
          <div class="carousel-item active">
            <!-- <img src="<?=ROOT?>/assets/img/hero-1.png" alt="" class="opacity-75"> -->
            <img src="<?=get_image($image->image)?>" alt="<?=esc($image->title)?>" class="opacity-75">
            <div class="container">
              <div class="carousel-caption text-start">
                <h1 data-aos="fade-up" data-aos-delay="100"><?=esc($image->title)?></h1>
                <code data-aos="fade-up" data-aos-delay="200" class="text-secondary fs-4"><?=esc($image->description)?></code>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                  <!-- <a href="<?=ROOT?>/courses" class="btn btn-primary">Get Started</a> -->
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        <!-- -------| ./Carousel\. |------- -->
      </div>
      <!-- -------| ./Carousel Sliders\. |------- -->
      <!-- ---------| Carousel Buttons |--------- -->
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <!-- -------| ./Carousel Buttons\. |------- -->
    </div>
  <?php else: ?>
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
      <!-- ---------| Carousel Indicators |--------- -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <!-- -------| ./Carousel Indicators\. |------- -->
      <!-- ---------| Carousel Sliders |--------- -->
      <div class="carousel-inner">
        <!-- ---------| Carousel-1 |--------- -->
        <div class="carousel-item active">
          <img src="<?=ROOT?>/assets/img/ielts.png" alt="" class="opacity-75">
          <div class="container">
            <div class="carousel-caption text-start">
              <h1 data-aos="fade-up" data-aos-delay="100">Your Path to IELTS Success<br>Starts Here.</h1>
              <code data-aos="fade-up" data-aos-delay="200" class="text-secondary fs-4">Join thousands of students<br>who achieved their target scores.</code>
              <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="<?=ROOT?>/courses" class="btn btn-primary">Get Started</a>
              </div>
            </div>
          </div>
        </div>
        <!-- -------| ./Carousel-1\. |------- -->
        <!-- ---------| Carousel-2 |--------- -->
        <div class="carousel-item">
          <img src="<?=ROOT?>/assets/img/hero-3.png" alt="" class="opacity-50">
          <div class="container">
            <div class="carousel-caption text-start">
              <h1 data-aos="fade-up" data-aos-delay="100"><strong>Learning Today,<br>Leading Tomorrow.</strong></h1>
              <code class="text-dark fs-4">Open unlocked doors and enlarge your horizon.</code>
            </div>
          </div>
        </div>
        <!-- -------| ./Carousel-2\. |------- -->
        <!-- ---------| Carousel-3 |--------- -->
        <div class="carousel-item">
          <img src="<?=ROOT?>/assets/img/hero-11.png" alt="" class="opacity-50">
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Our moto</h1>
              <p class="text-dark shadow-2 fs-4">Learn English in a simple&comma; calm <span style="color: crimson;">&AMP;</span> friendly way.</p>
            </div>
          </div>
        </div>
        <!-- -------| ./Carousel-3\. |------- -->
      </div>
      <!-- -------| ./Carousel Sliders\. |------- -->
      <!-- ---------| Carousel Buttons |--------- -->
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <!-- -------| ./Carousel Buttons\. |------- -->
    </div>
  <?php endif; ?>
  <!-- -------| ./Hero Section\. |------- -->

  <!-- ---------| About Section |--------- -->
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
  <!-- -------| ./About Section\. |------- -->

  <!-- ---------| Counters Section |--------- -->
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
  <!-- -------| ./Counters Section\. |------- -->

  <!-- ---------| Why Us Section |--------- -->
  <section id="why-us" class="section why-us light-background">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-box">
            <img src="./assets/img/favico.png" alt="Logo" class="w-25">
            <h3>Why Choose<br>
              <i class="fs-4">&nbsp;<q>
                <span><span style="color: crimson;">IELTS</span> English <span style="color: orangered;">Tips</span></span>
              </q>&nbsp;&quest;</i>
            </h3>
            <p class="text-center">My courses are designed by an experienced instructor and tailored to meet every individual needs.</p>
            <div class="text-center">
              <a href="<?=ROOT?>/faculty" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
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
  <!-- -------| ./Why Us Section\. |------- -->

  <!-- ---------| get Features Section |--------- -->

  <!-- ---------| Courses Section |--------- -->
  <section id="courses" class="courses section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Checkout</h2>
      <p>Our Popular Courses</p>
    </div>
    <!-- ./Section Title\. -->

    <div class="container">

      <div class="row">

        <?php if (!empty($rows)): ?>
          <?php foreach ($rows as $row): ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="course-item">
                <img src="<?=get_image($row->course_image)?>" class="img-fluid" alt="<?=esc($row->title)?>">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="category"><a href="<?=ROOT?>/courses/course-details/<?=esc($row->id)?>" class="text-white"><?=esc($row->category_row->category)?></a></p>
                    <p class="price">
                      <?=esc($row->currency_row->symbol)?><?=esc($row->price_row->price)?> <sup><?=esc($row->currency_row->currency)?></sup>
                    </p>
                  </div>
    
                  <h3><a href="#"><?=esc($row->title)?></a></h3>
                  <p class="description"><?=esc($row->description)?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="./assets/img/course-1.png" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <p class="category"><a href="<?=ROOT?>/courses/course-details/1" class="text-white">IELTS Preparation</a></p>
                  <p class="price">1000 <sup>EGP</sup></p>
                </div>
  
                <h3><a href="#">IELTS Intensive Course</a></h3>
                <p class="description">Boost your score quickly with our intensive preparation course.</p>
              </div>
            </div>
          </div>
          <!-- End Course Item-->
  
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="course-item">
              <img src="./assets/img/course-2.png" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <p class="category"><a href="<?=ROOT?>/courses/course-details/2" class="text-white">English Course</a></p>
                  <p class="price">750 <sup>EGP</sup></p>
                </div>
  
                <h3><a href="#">Headway Curriculum</a></h3>
                <p class="description">Get ready for journey in learining the English language.</p>
              </div>
            </div>
          </div>
          <!-- End Course Item-->
  
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="course-item">
              <img src="./assets/img/course-3.png" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <p class="category"><a href="<?=ROOT?>/courses/course-details/3" class="text-white">I.T</a></p>
                  <p class="price">750 <sup>EGP</sup></p>
                </div>
  
                <h3><a href="#">Computer Science</a></h3>
                <p class="description">Learn how devices work and connect with the rest of the world.</p>
              </div>
            </div>
          </div>
          <!-- End Course Item-->
        <?php endif; ?>

      </div>

    </div>

  </section>
  <!-- -------| ./Courses Section\. |------- -->

  <!-- ---------| Faculty Section |--------- -->
  <section id="trainers-index" class="section trainers-index light-background">

    <div class="container">

      <div class="row">

        <div class="col-lg-4 col-md-6 mx-auto" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <img src="<?=ROOT?>/assets/img/teachers-3.png" class="img-fluid" alt="">
            <div class="member-content">
              <h4>Mohammed Abbo</h4>
              <span><strong style="color: crimson;">IELTS</strong> <strong style="color: #5578ff;">English</strong> <strong style="color: orangered;">Tips</strong></span>
              <p>
                I created <span class="d-inline fw-bold" style="color: crimson;">IELTS</span> <span class="d-inline fw-bold" style="color: #5578ff;">English</span> <span class="d-inline fw-bold" style="color: orangered;">Tips</span> for one reason&colon; to help students <strong>break free</strong> from confusion and finally get the <strong>IELTS</strong> score they deserve.
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Team Member -->
      </div>

    </div>

  </section>
  <!-- -------| ./Faculty Section\. |------- -->

  <!-- Call to Action -->
  <section data-aos="fade-up" data-aos-delay="100" class="hero section">
    <div class="container text-center">
      <h2 data-aos="fade-up" data-aos-delay="100">Ready to Start Your IELTS Journey&quest;</h2>
      <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="./courses" class="btn btn-primary rounded-pill">Enrole Now</a>
      </div>
    </div>
  </section>
  <!-- /Call to Action -->
</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>