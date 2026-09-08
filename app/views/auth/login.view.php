<?php $this->view('partials/private.header',$data) ?>

<!-- ---------| Main |--------- -->
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column my-auto me-5 w-50">
            <img src="<?=ROOT?>/assets/img/brand.png" alt="Logo" class="">
          </div>

          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="<?=ROOT?>" class="logo d-flex align-items-center w-auto">
                <span class="d-none d-lg-block"><span style="color: crimson;">IELTS</span> <span style="color: #5578ff;">English</span> <span style="color: orangered;">Tips</span></span>
              </a>
            </div>
            <!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your username & password to login</p>
                </div>

                <!-- ---- CHECK MESSAGE ---- -->
                <?php if(message()):?>
                  <div class="alert alert-success text-center fontClarity"><?=message('',true)?></div>
                <?php endif;?>
                <?php if(!empty($errors['email'])):?>
                  <div class="alert alert-danger text-center fontClarity"><?=$errors['email']?>!</div>
                <?php endif;?>
                <!-- -| ./CHECK MESSAGE\. |- -->

                <form method="post" class="row g-3 needs-validation" novalidate>

                  <!-- ---- E-mail ---- -->
                  <div class="col-12">
                    <!-- <label for="youremail" class="form-label">E-mail</label> -->
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="email" class="form-control" id="youremail" value="<?= set_value('email')?>" placeholder="E-mail" required1 autofocus>
                      <div class="invalid-feedback">Please, enter your E-mail.</div>
                    </div>
                  </div>
                  <!-- -| ./E-mail\. |- -->

                  <!-- ---- Password ---- -->
                  <div class="col-12">
                    <!-- <label for="yourPassword" class="form-label">Password</label> -->
                    <input type="password" name="password" class="form-control" id="yourPassword" value="<?= set_value('password')?>" placeholder="Password" required1>
                    <div class="invalid-feedback">Please, enter your password!</div>
                  </div>
                  <!-- -| ./Password\. |- -->

                  <!-- ---- RememberMe ---- -->
                  <!-- <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                  </div> -->
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

          </div>
        </div>
      </div>

    </section>

  </div>
</main>
<!-- -------| ./Main\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
