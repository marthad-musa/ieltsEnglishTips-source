    <footer id="footer" class="footer position-relative">

      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="<?=ROOT?>/" class="logo d-flex align-items-center">
              <span class="fs-6" style="color: crimson;">IELTS</span>&nbsp;<span class="fs-6" style="color: #4f70f1">English</span>&nbsp;<span class="fs-6" style="color: orangered;">Tips</span>
            </a>
            <div class="footer-contact pt-3">
              <p class="mt-3"><strong>CEO-Founder&colon;</strong> <span>Mohammed Abbo</span></p>
              <p class="mt-3"><strong>Phone&colon;</strong> <span>&plus;20 155 749 7220</span></p>
              <p class="mb-3"><strong>Whatsapp&colon;</strong> <span>&plus;20 115 246 5749</span></p>
              <p><strong>E-mail&colon;</strong> <span>mohammedabbo52@gmail.com</span></p>
              <p><strong>Address&colon;</strong> <span>Badr City&comma; Cairo Governorate&comma; EGYPT.</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href="https://facebook.com/profile.php?id=61589605594479"><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-tiktok"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="<?=ROOT?>/">Home</a></li>
              <li><a href="<?=ROOT?>/about">About</a></li>
              <li><a href="<?=ROOT?>/faculty">Faculty</a></li>
              <li><a href="<?=ROOT?>/blog">Announcement</a></li>
              <li><a href="<?=ROOT?>/login">Login</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Courses</h4>
            <ul>
              <li><a href="<?=ROOT?>/courses/ielts-academic">IELTS Academic</a></li>
              <li><a href="<?=ROOT?>/courses/ielts-general-training">IELTS General Training</a></li>
              <li><a href="<?=ROOT?>/courses/english-headway">English Headway</a></li>
              <li><a href="<?=ROOT?>/courses/icdl">ICDL</a></li>
              <li><a href="<?=ROOT?>/signup">Register</a></li>
              <!-- <li><a href="">Terms of service</a></li>
              <li><a href="">Privacy policy</a></li> -->
            </ul>
          </div>

        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p><?=date('Y')?> &copy; <span>Copyright</span> <strong class="px-1 sitename"><?=APPNAME?></strong> <span>All Rights Reserved</span></p>
        <div class="credits">
          Developed by&colon; <a href="https://www.linkedin.com/in/marthad-musa-78389039/"><?=AUTHOR?></a>
        </div>
      </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- ---- JavaScript Scripts ---- -->
    <?php $this->view('partials/script',$data) ?>
    <!-- -| ./JavaScript Scripts\. |. -->

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

</html>