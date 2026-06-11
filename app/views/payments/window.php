<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card card-body bg-light mt-5">
            <h2>Payment for <?php echo $data['course'] ? $data['course']->title : 'Enrollment'; ?></h2>
            <p>Select your payment method</p>
            <form action="<?php echo URLROOT; ?>/payments/process" method="post">
              <input type="hidden" name="course_id" value="<?php echo $data['course']->id; ?>">
              
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="gateway" id="paypal" value="paypal" checked>
                <label class="form-check-label" for="paypal">
                  <i class="bi bi-paypal me-2"></i>PayPal
                </label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="gateway" id="stripe" value="stripe">
                <label class="form-check-label" for="stripe">
                  <i class="bi bi-credit-card me-2"></i>Mastercard / Visacard
                </label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="gateway" id="bank" value="bank_transfer">
                <label class="form-check-label" for="bank">
                  <i class="bi bi-bank me-2"></i>Bank of Khartoum
                </label>
              </div>

              <div class="alert alert-info">
                Total Amount: <strong><?php echo $data['course']->price; ?> EGP</strong>
              </div>

              <input type="submit" value="Pay Now" class="btn btn-success w-100 p-3">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
