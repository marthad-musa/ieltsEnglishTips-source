<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-10.png" alt="" data-aos="fade-in" class="opacity-75">

      <div class="container text-center">
        <h2 data-aos="fade-up" data-aos-delay="100">Events</h2>
        <p data-aos="fade-up" data-aos-delay="200">Join our community and take advantage of what we offer.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Events<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- Events Section -->
  <section id="events" class="events section">

    <div class="container">

      <div class="row">
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img src="<?=ROOT?>/assets/img/male-student.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">Introduction to webdesign</a></h5>
              <p class="fst-italic text-center">Sunday, September 26th at 7:00 pm</p>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-img">
              <img src="<?=ROOT?>/assets/img/female-student.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">Marketing Strategies</a></h5>
              <p class="fst-italic text-center">Sunday, November 15th at 7:00 pm</p>
              <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
            </div>
          </div>

        </div>
      </div>

    </div>

  </section>
  <!-- -------| ./Events Section\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>