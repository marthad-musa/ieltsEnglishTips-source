<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <!-- <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>404</h1>
            <p class="mb-0">Error, page not found.</p>
          </div>
        </div>
      </div>
    </div> -->
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">404</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- Starter Section Section -->
  <section id="starter-section" class="starter-section section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <p>Error<br></p>
      <h2>Page not found.</h2>
    </div>
    <!-- End Section Title -->

    <div class="container text-center fs-4" data-aos="fade-up">
      <p>Sorry&comma; we can't locate this page.</p>
      <img src="<?=ROOT?>/assets/img/404.svg" alt="404 error" class="w-25">
    </div>

  </section>
  <!-- /Starter Section Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>