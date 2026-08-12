    <!-- ---------| FOOTER |--------- -->
    <footer id="footer" class="footer position-relative light-background">

      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">
                <span class="fs-6" style="color: crimson;">IELTS</span> <span class="fs-6" style="color: #5578ff;">English</span> <span class="fs-6" style="color: orangered;">Tips</span>
              </span>
            </a>

            <div class="footer-contact pt-3">
              <p class="mt-3"><strong>CEO-Founder&colon;</strong> <span>Mohammed Abbo</span></p>
              <p class="mb-3"><strong>Whatsapp&colon;</strong> <span>&plus;20 115 246 5749</span></p>
              <p><strong>E-mail&colon;</strong> <span>mohammedabbo52@gmail.com</span></p>
              <p><strong>Address&colon;</strong> <span>Badr City&comma; Cairo Governorate&comma; EGYPT.</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href="https://facebook.com/profile.php?id=61589605594479"><i class="bi bi-facebook"></i></a>
              <a href="https://instagram.com/"><i class="bi bi-instagram"></i></a>
              <a href="https://x.com/"><i class="bi bi-twitter-x"></i></a>
              <a href="https://tiktok.com/@"><i class="bi bi-tiktok"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="<?=ROOT?>/">Home</a></li>
              <li><a href="<?=ROOT?>/about">About</a></li>
              <li><a href="<?=ROOT?>/faculty">Faculty</a></li>
              <li><a href="<?=ROOT?>/events">Events</a></li>
              <li><a href="<?=ROOT?>/contact">Contact</a></li>
              <!-- <li><a href="<?=ROOT?>/login">Login</a></li> -->
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Courses</h4>
            <ul>
              <li><a href="<?=ROOT?>/courses/1">IELTS Academic</a></li>
              <li><a href="<?=ROOT?>/courses/1">IELTS General Training</a></li>
              <li><a href="<?=ROOT?>/courses/2">English Headway</a></li>
              <li><a href="<?=ROOT?>/courses/3">ICDL</a></li>
              <li><a href="<?=ROOT?>/courses">More courses</a></li>
              <!-- <li><a href="<?=ROOT?>/">Terms of service</a></li>
              <li><a href="<?=ROOT?>/">Privacy policy</a></li> -->
            </ul>
          </div>

          <div class="col-lg-4 col-md-12 footer-newsletter">
            <img src="<?=ROOT?>/<?=BRAND?>" alt="Logo" class="w-75">
          </div>

        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p><?=APPYEAR?> &copy; <span>Copyright</span> <strong class="px-1 sitename fontAlido h6" title="<?=APPNAME?>"><?=APPNAME?></strong>. <span>All Rights Reserved</span></p>
        <div class="credits">
          Developed by&colon; <a href="https://www.linkedin.com/in/marthad-musa-78389039/" class="fs-6 fontClarity">Marthad Musa</a>
        </div>
      </div>

    </footer>
    <!-- -------| ./FOOTER\. |------- -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- ---------| Floating Language Switch Button |--------- -->
    <!-- <button class="btn floating-translate-btn" title="Translate" data-aos="fade-up" style="background-color: #5578ff; color: white; position: fixed; bottom: 75px; right: 14px; z-index: 100001; padding: 10px 15px; border-radius: 50px; display: flex; align-items: center; gap: 8px; font-weight: 500;" title="Switch to Arabic">
      <i class="bi bi-translate" style="font-size: 18px;"></i>
    </button> -->
    <!-- -------| ./Floating Language Switch Button\. |------- -->

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- ---- Vendor JavaScript Scripts ---- -->
    <?php $this->view('partials/public.script',$data) ?>
    <!-- -| ./Vendor JavaScript Scripts\. |- -->
  </body>

</html>