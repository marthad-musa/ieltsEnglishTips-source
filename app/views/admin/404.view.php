<?php $this->view('partials/private.header',$data) ?>

<!-- ---------| Main |--------- -->
<main>
  <div class="container">
    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
      <h1>404</h1>
      <h2>The page you are looking for doesn't exist.</h2>
      <a class="btn btn-secondary" href="<?=ROOT?>/admin/dashboard">Back to dashboard</a>
      <img src="<?=ROOT?>/assets/img/404-not-found.svg" class="img-fluid py-5" alt="Page Not Found">
    </section>
  </div>
</main>
<!-- -------| ./Main\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
