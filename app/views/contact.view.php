<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-5.png" alt="" data-aos="fade-in">

      <div class="container text-center">
        <h2 data-aos="fade-up" data-aos-delay="100">Contact</h2>
        <p data-aos="fade-up" data-aos-delay="200">Have any questions&comma; feedback&comma; or suggestions&quest; Please&comma; feel free to contact us.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Contact<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
      <iframe style="border:0; width: 100%; height: 300px;" src="https://maps.app.goo.gl/ftAMxnWL5z9sp6rLA" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> -->
    <!-- End Google Maps -->

    <div class="container pt-5" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Address</h3>
              <p><span>Badr City&comma; Cairo Governorate&comma; EGYPT.</span></p>
            </div>
          </div>
          <!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Call Us</h3>
              <p><span>&plus;20 115 246 5749</span></p>
            </div>
          </div>
          <!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Email Us</h3>
              <p><span>mohammedabbo52@gmail.com</span></p>
            </div>
          </div>
          <!-- End Info Item -->

        </div>

        <div class="col-lg-8">
          <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
              </div>

              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
              </div>

            </div>
          </form>
        </div><!-- End Contact Form -->

      </div>

    </div>

  </section>
  <!-- /Contact Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>