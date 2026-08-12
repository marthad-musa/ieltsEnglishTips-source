<?php $this->view('partials/private.header',$data) ?>

<!-- ---------| Navigation |--------- -->
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column my-auto me-5">
            <img src="<?=ROOT?>/assets/img/brand.png" alt="Logo" style="max-width: 450px; start: 10px;">
          </div>

          <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <!-- ---------| Logo |--------- -->
            <div class="d-flex justify-content-center py-4">
              <a href="<?=ROOT?>" class="logo d-flex align-items-center w-auto">
                <span class="d-none d-lg-block"><span style="color: crimson;">IELTS</span> <span style="color: #5578ff;">English</span> <span style="color: orangered;">Tips</span></span>
              </a>
            </div>
            <!-- -------| ./Logo\. |------- -->

            <div class="card rounded mb-3">
              <div class="card-body">
                <div class="pt-2 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form method="post" class="row g-3 needs-validation" autocomplete="off" novalidate>
                  <!-- ---- FIRST NAME ---- -->
                  <div class="col-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control <?=!empty($errors['firstname']) ? 'border-danger' : '';?>" id="firstname" value="<?= set_value('firstname')?>" placeholder="Please, enter your firstname" required autofocus>
                    <div class="invalid-feedback">Please, enter your first name!</div>
                    <?php if(!empty($errors['firstname'])):?>
                      <small class="text-danger"><?=$errors['firstname']?>!</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./FIRST NAME\. |- -->

                  <!-- ---- LAST NAME ---- -->
                  <div class="col-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control <?=!empty($errors['lastname']) ? 'border-danger' : '';?>" id="lastname" value="<?= set_value('lastname')?>" placeholder="Please, enter your lastname" required>
                    <div class="invalid-feedback">Please, enter your last name!</div>
                    <?php if(!empty($errors['lastname'])):?>
                      <small class="text-danger"><?=$errors['lastname']?>!</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./LAST NAME\. |- -->

                  <!-- ---- E-MAIL ---- -->
                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Your E-mail</label>
                    <input type="email" name="email" class="form-control <?=!empty($errors['email']) ? 'border-danger' : '';?>" id="yourEmail" value="<?= set_value('email')?>" placeholder="Please, enter your email" required>
                    <div class="invalid-feedback">Please, enter a valid Email adddress!</div>
                    <?php if(!empty($errors['email'])):?>
                      <small class="text-danger"><?=$errors['email']?>!</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./E-MAIL\. |- -->

                  <!-- ---- USERNAME ---- -->
                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="username" class="form-control <?=!empty($errors['username']) ? 'border-danger' : '';?>" id="yourUsername" value="<?= set_value('username')?>" placeholder="Please, enter your username" required>
                      <div class="invalid-feedback">Please, choose a username.</div>
                      <?php if(!empty($errors['username'])):?>
                        <small class="text-danger"><?=$errors['username']?>.</small>
                      <?php endif;?>
                    </div>
                  </div>
                  <!-- -| ./USERNAME\. |- -->

                  <!-- ---- COMPANY ---- -->
                  <!-- <div class="col-6">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" name="company" class="form-control <?=!empty($errors['company']) ? 'border-danger' : '';?>" id="company" value="<?= set_value('company')?>" placeholder="Please, enter your company" required autofocus>
                    <div class="invalid-feedback">Please, enter your company name!</div>
                    <?php if(!empty($errors['company'])):?>
                      <small class="text-danger"><?=$errors['company']?>!</small>
                    <?php endif;?>
                  </div> -->
                  <!-- -| ./COMPANY\. |- -->

                  <!-- ---- JOB ---- -->
                  <!-- <div class="col-6">
                    <label for="job" class="form-label">Job</label>
                    <input type="text" name="job" class="form-control <?=!empty($errors['job']) ? 'border-danger' : '';?>" id="job" value="<?= set_value('job')?>" placeholder="Please, enter your job" required autofocus>
                    <div class="invalid-feedback">Please, enter your job title!</div>
                    <?php if(!empty($errors['job'])):?>
                      <small class="text-danger"><?=$errors['job']?>!</small>
                    <?php endif;?>
                  </div> -->
                  <!-- -| ./JOB\. |- -->

                  <!-- ---- COUNTRY ---- -->
                  <!-- <div class="col-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" name="country" class="form-control <?=!empty($errors['country']) ? 'border-danger' : '';?>" id="country" value="<?= set_value('country')?>" placeholder="Please, enter your country" required autofocus>
                    <div class="invalid-feedback">Please, enter your country!</div>
                    <?php if(!empty($errors['country'])):?>
                      <small class="text-danger"><?=$errors['country']?>!</small>
                    <?php endif;?>
                  </div> -->
                  <!-- -| ./COUNTRY\. |- -->

                  <!-- ---- ADDRESS ---- -->
                  <!-- <div class="col-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control <?=!empty($errors['address']) ? 'border-danger' : '';?>" id="address" value="<?= set_value('address')?>" placeholder="Please, enter your address" required autofocus>
                    <div class="invalid-feedback">Please, enter your address!</div>
                    <?php if(!empty($errors['address'])):?>
                      <small class="text-danger"><?=$errors['address']?>!</small>
                    <?php endif;?>
                  </div> -->
                  <!-- -| ./ADDRESS\. |- -->

                  <!-- ---- PHONE ---- -->
                  <!-- <div class="col-12">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control <?=!empty($errors['phone']) ? 'border-danger' : '';?>" id="phone" value="<?= set_value('phone')?>" placeholder="Please, enter your phone number" required autofocus>
                    <div class="invalid-feedback">Please, enter your phone!</div>
                    <?php if(!empty($errors['phone'])):?>
                      <small class="text-danger"><?=$errors['phone']?>!</small>
                    <?php endif;?>
                  </div> -->
                  <!-- -| ./PHONE\. |- -->

                  <!-- ---- BIOGRAPHY ---- -->
                  <!-- <div class="col-12">
                    <label for="yourBio" class="form-label">About</label>
                    <div class="input-group has-validation">
                      <textarea name="bio" class="form-control <?=!empty($errors['bio']) ? 'border-danger' : '';?>" id="yourBio" value="<?= set_value('bio')?>" placeholder="Please, enter your biography" required></textarea>
                      <div class="invalid-feedback">Please, write a biography.</div>
                      <?php if(!empty($errors['bio'])):?>
                        <small class="text-danger"><?=$errors['bio']?>.</small>
                      <?php endif;?>
                    </div>
                  </div> -->
                  <!-- -| ./BIOGRAPHY\. |- -->

                  <!-- ---- PASSWORD ---- -->
                  <div class="col-6">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control <?=!empty($errors['password']) ? 'border-danger' : '';?>" id="yourPassword" value="<?= set_value('password')?>" placeholder="Please, enter your password" required>
                    <div class="invalid-feedback">Please, enter your password!</div>
                    <?php if(!empty($errors['password'])):?>
                      <small class="text-danger"><?=$errors['password']?>!</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./PASSWORD\. |- -->

                  <!-- ---- RetypePASSWORD ---- -->
                  <div class="col-6">
                    <label for="yourPassword" class="form-label">Retype Password</label>
                    <input type="password" name="retype_password" class="form-control <?=!empty($errors['retype_password']) ? 'border-danger' : '';?>" id="yourPassword" value="<?= set_value('retype_password')?>" placeholder="Please, re-type your password" required>
                    <div class="invalid-feedback">Please, re-type your password!.</div>
                    <?php if(!empty($errors['retype_password'])):?>
                      <small class="text-danger"><?=$errors['retype_password']?>!</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./RetypePASSWORD\. |- -->

                  <!-- ---- LANGUAGE ---- -->
                  <div class="col-12">
                    <select class="form-select text-start mb-1 py-3 <?=!empty($errors['language']) ? 'border-danger' : '';?>" name="language" aria-label=".form-select example">
                      <option class="fs-6 fw-bold" selected disabled>- Language -</option>
                      <option class="fs-6" value="en" <?=set_select('language','en')?>>English</option>
                      <option class="fs-6" value="ar" <?=set_select('language','ar')?>>Arabic</option>
                      <!-- <option class="fs-6" value="fr" <?=set_select('language','fr')?>>Fronce</option> -->
                    </select>
                    <div class="invalid-feedback">Please, choose a language.</div>
                    <?php if(!empty($errors['language'])):?>
                      <small class="text-danger"><?=$errors['language']?>.</small>
                    <?php endif;?>
                  </div>
                  <!-- -| ./LANGUAGE\. |- -->

                  <!-- ---- TERMS ---- -->
                  <div class="col-12">
                    <div class="form-switch my-3 ms-0 form-check text-start">
                      <input class="form-check-input" name="terms" type="checkbox" value="1" <?= set_value('terms') ? 'checked': ''; ?> role="switch" id="flexSwitchCheckChecked" required>
                      <label class="form-check-label" for="flexCheckDefault">
                        <span class="fs-6">I agree and accept the <a href="#">terms and conditions</a></span>
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                      <?php if(!empty($errors['terms'])):?>
                        <small class="text-danger"><?=$errors['terms']?>.</small>
                      <?php endif;?>
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
      </div>

    </section>

  </div>
</main>
<!-- -------| ./Navigation\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
