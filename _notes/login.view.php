<?php $this->view('partials/header', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- Contact Section -->
  <section id="contact" class="contact section mt-5">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 mt-2">

        <div class="container col-xl-10 col-xxl-8 px-4">
          <div class="row align-items-center g-lg-5">
            <div class="col-md-10 mx-auto col-lg-5">
              <div class="card-body">
                <div class="pt-2 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form method="post" class="row g-3 needs-validation" autocomplete="off" novalidate="">
                  <!-- ---- FIRST NAME ---- -->
                  <div class="col-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control " id="firstname" value="" required="" autofocus="">
                    <div class="invalid-feedback">Please, enter your first name!</div>
                  </div>
                  <!-- -| ./FIRST NAME\. |- -->

                  <!-- ---- LAST NAME ---- -->
                  <div class="col-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control " id="lastname" value="" required="">
                    <div class="invalid-feedback">Please, enter your last name!</div>
                  </div>
                  <!-- -| ./LAST NAME\. |- -->

                  <!-- ---- E-MAIL ---- -->
                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Your E-mail</label>
                    <input type="email" name="email" class="form-control " id="yourEmail" value="" required="">
                    <div class="invalid-feedback">Please, enter a valid Email adddress!</div>
                  </div>
                  <!-- -| ./E-MAIL\. |- -->

                  <!-- ---- USERNAME ---- -->
                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="username" class="form-control " id="yourUsername" value="" required="">
                      <div class="invalid-feedback">Please, choose a username.</div>
                    </div>
                  </div>
                  <!-- -| ./USERNAME\. |- -->

                  <!-- ---- PASSWORD ---- -->
                  <div class="col-6">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control " id="yourPassword" value="" required="">
                    <div class="invalid-feedback">Please, enter your password!</div>
                  </div>
                  <!-- -| ./PASSWORD\. |- -->

                  <!-- ---- RetypePASSWORD ---- -->
                  <div class="col-6">
                    <label for="yourPassword" class="form-label">Retype Password</label>
                    <input type="password" name="retype_password" class="form-control " id="yourPassword" value="" required="">
                    <div class="invalid-feedback">Please, re-type your password!.</div>
                  </div>
                  <!-- -| ./RetypePASSWORD\. |- -->

                  <!-- ---- LANGUAGE ---- -->
                  <div class="col-12">
                    <select class="form-select text-start mb-1 py-3 " name="language" aria-label=".form-select example">
                      <option class="fs-6 fw-bold" selected="" disabled="">- Language -</option>
                      <option class="fs-6" value="en">English</option>
                      <option class="fs-6" value="ar">Arabic</option>
                    </select>
                    <div class="invalid-feedback">Please, choose a language.</div>
                  </div>
                  <!-- -| ./LANGUAGE\. |- -->

                  <!-- ---- TERMS ---- -->
                  <div class="col-12">
                    <div class="form-switch my-3 ms-0 form-check text-start">
                      <input class="form-check-input" name="terms" type="checkbox" value="1" role="switch" id="flexSwitchCheckChecked" required="">
                      <label class="form-check-label" for="flexCheckDefault">
                        <span class="fs-6 fw-bold">I agree and accept the <a href="#">terms and conditions</a></span>
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>
                  <!-- -| ./TERMS\. |- -->

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="<?=ROOT?>/login">Log in</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Contact Form -->

      </div>

    </div>

  </section>
  <!-- /Contact Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/footer',$data) ?>