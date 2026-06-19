<?php $this->view('partials/header', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main bg-light">
  <div class="container bg-light">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 bg-light">
      <div class="container bg-light">
        <div class="row justify-content-center bg-light">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-2">
              <a href="<?=ROOT?>/" class="logo d-flex align-items-center w-auto">
                <img src="<?=ROOT?>/assets/img/logo.png" alt="Logo" style="max-width: 100px; max-height: 100px;">
                <strong class="d-none d-lg-block"><span class="fs-6" style="color: crimson;">IELTS</span>&nbsp;<span class="fs-6" style="color: #4f70f1">English</span>&nbsp;<span class="fs-6" style="color: orangered;">Tips</span></strong>
              </a>
            </div>
            <!-- End Logo -->
            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your E-mail &amp; password to login</p>
                </div>

                <!-- ---- CHECK MESSAGE ---- -->
                <!-- -| ./CHECK MESSAGE\. |- -->

                <form method="post" class="row g-3 needs-validation" novalidate="">

                  <!-- ---- E-mail ---- -->
                  <div class="col-12">
                    <!-- <label for="youremail" class="form-label">E-mail</label> -->
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="email" class="form-control" id="youremail" value="<?= set_value('email')?>" placeholder="E-mail" required="" autofocus="">
                      <div class="invalid-feedback">Please, enter your E-mail.</div>
                    </div>
                  </div>
                  <!-- -| ./E-mail\. |- -->

                  <!-- ---- Password ---- -->
                  <div class="col-12">
                    <!-- <label for="yourPassword" class="form-label">Password</label> -->
                    <input type="password" name="password" class="form-control" id="yourPassword" value="" placeholder="Password" required="">
                    <div class="invalid-feedback">Please, enter your password!</div>
                  </div>
                  <!-- -| ./Password\. |- -->

                  <!-- ---- RememberMe ---- -->
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                  </div>
                  <!-- -| ./RememberMe\. |- -->
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Don't have account? <a href="<?=ROOT?>/signup">Create an account</a></p>
                  </div>
                </form>

              </div>
            </div>

            <div class="container copyright text-center mt-2">
              <strong class="px-1 sitename"><span class="fs-6" style="color: crimson;">IELTS</span>&nbsp;<span class="fs-6" style="color: #4f70f1">English</span>&nbsp;<span class="fs-6" style="color: orangered;">Tips</span></strong>
              <p><?=date('Y')?> &copy; <span>Copyright</span> <span>All Rights Reserved</span></p>
              <div class="credits">
                Developed by&colon; <a href="https://www.linkedin.com/in/marthad-musa-78389039/"><?=AUTHOR?></a>
              </div>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/script',$data) ?>
</html>