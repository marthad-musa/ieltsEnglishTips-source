<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card card-body bg-light mt-5">
            <h2>Complete Your Profile</h2>
            <p>Please provide additional information to continue</p>
            <form action="<?php echo URLROOT; ?>/users/complete_profile" method="post">
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="city">City: <sup>*</sup></label>
                  <input type="text" name="city" class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['city']; ?>">
                  <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">State: <sup>*</sup></label>
                  <input type="text" name="state" class="form-control <?php echo (!empty($data['state_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['state']; ?>">
                  <span class="invalid-feedback"><?php echo $data['state_err']; ?></span>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="country">Country: <sup>*</sup></label>
                  <input type="text" name="country" class="form-control <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['country']; ?>">
                  <span class="invalid-feedback"><?php echo $data['country_err']; ?></span>
                </div>
              </div>
              
              <div class="form-group mb-3">
                <label for="mobile">Mobile Number: <sup>*</sup></label>
                <input type="text" name="mobile" class="form-control <?php echo (!empty($data['mobile_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['mobile']; ?>">
                <span class="invalid-feedback"><?php echo $data['mobile_err']; ?></span>
              </div>

              <?php if($_SESSION['user_role'] == 'teacher') : ?>
                <div class="form-group mb-3">
                    <label for="subject_to_teach">Subject to Teach: <sup>*</sup></label>
                    <input type="text" name="subject_to_teach" class="form-control" value="<?php echo $data['subject_to_teach']; ?>">
                </div>
              <?php endif; ?>

              <hr>
              <h5>Social Media Accounts (Optional)</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="facebook">Facebook:</label>
                  <input type="text" name="facebook" class="form-control" value="<?php echo $data['facebook']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="instagram">Instagram:</label>
                  <input type="text" name="instagram" class="form-control" value="<?php echo $data['instagram']; ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="twitter">X (Twitter):</label>
                  <input type="text" name="twitter" class="form-control" value="<?php echo $data['twitter']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tiktok">TikTok:</label>
                  <input type="text" name="tiktok" class="form-control" value="<?php echo $data['tiktok']; ?>">
                </div>
              </div>

              <input type="submit" value="Save & Continue" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
