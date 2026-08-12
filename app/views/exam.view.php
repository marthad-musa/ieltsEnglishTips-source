<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="assets/img/hero-5.png" alt="" data-aos="fade-in">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Page Starter</h2>
        <p data-aos="fade-up" data-aos-delay="200">Join our community and take advantage of what we offer.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.html">Home</a></li>
          <li class="current">Page Starter<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- Starter Section Section -->
  <section id="starter-section" class="starter-section section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Starter Section</h2>
      <p>Your Description Here<br></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up">
      <p>Use this page as a starter for your own custom pages.</p>
    </div>

  </section><!-- /Starter Section Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>