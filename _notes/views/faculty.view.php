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
            <h1>Teachers</h1>
            <p class="mb-0">Our instructors are passionate about helping students achieve their IELTS score goals, experienced in delivering effective IELTS preparation courses and dedicated to your success.&nbsp;They bring a wealth of knowledge and proven strategies to help you conquer the IELTS exam.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>/">Home</a></li>
          <li class="current">Teachers</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Trainers Section -->
  <section id="trainers" class="section trainers">

    <div class="container">

      <div class="row gy-5">

        <div class="col-lg-4 col-md-6 member mx-auto" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img">
            <img src="<?=ROOT?>/assets/img/teachers-1.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href="https://www.facebook.com/profile.php?id=61589605594479"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-tiktok"></i></a>
            </div>
          </div>
          <div class="member-info text-center">
            <h4>Mohammed Abbo</h4>
            <span>IELTS Instructor</span>
            <p>I created IELTS English Tips for one reason&colon; to help students break free from confusion and finally get the IELTS score they deserve.</p>
          </div>
        </div>
        <!-- End Team Member -->

      </div>

    </div>

  </section><!-- /Trainers Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/footer',$data) ?>