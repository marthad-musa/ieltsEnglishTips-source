<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-11.png" alt="" data-aos="fade-in">

      <div class="container text-start">
        <h2 data-aos="fade-up" data-aos-delay="100">Courses</h2>
        <p data-aos="fade-up" data-aos-delay="200">Explore our comprehensive courses<br>designed to help you optain your future goals.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Courses<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- ---------| Courses Section |--------- -->
  <section id="courses" class="courses section">

    <div class="container">

      <div class="row">

        <?php if (!empty($rows)): ?>
          <?php foreach ($rows as $row): ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="course-item">
                <img src="<?=get_image($row->course_image)?>" class="img-fluid" alt="<?=esc($row->title)?>">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="category"><a href="<?=ROOT?>/<?php
                      if(esc($row->id) == 1) {
                        echo 'ielts';
                      } elseif (esc($row->id) == 2) {
                        echo 'headway';
                      } elseif (esc($row->id) == 3) {
                        echo 'computer';
                      } else {
                        echo '#';
                      }?>
                    " class="text-white"><?=esc($row->category_row->category)?></a></p>
                    <p class="price">
                      <?=esc($row->currency_row->symbol)?><?=esc($row->price_row->price)?> <sup><?=esc($row->currency_row->currency)?></sup>
                    </p>
                  </div>
    
                  <h3><a href="<?=ROOT?>/<?php
                    if(esc($row->id) == 1) {
                      echo 'ielts';
                    } elseif (esc($row->id) == 2) {
                      echo 'headway';
                    } elseif (esc($row->id) == 3) {
                      echo 'computer';
                    } else {
                      echo '#';
                    }?>
                  "><?=esc($row->title)?></a></h3>
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
                  <p class="category"><a href="<?=ROOT?>/courses/1" class="text-white">IELTS Preparation</a></p>
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
                  <p class="category"><a href="<?=ROOT?>/courses/2" class="text-white">English Course</a></p>
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
                  <p class="category"><a href="<?=ROOT?>/courses/3" class="text-white">I.T</a></p>
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

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>