<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-11.png" alt="" data-aos="fade-in" class="opacity-50">

      <div class="container text-start">
        <h2 data-aos="fade-up" data-aos-delay="100">Courses</h2>
        <p data-aos="fade-up" data-aos-delay="200">Explore our comprehensive courses<br>designed to help you optain your future goals.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Courses<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- ---------| Courses Section |--------- -->
  <section id="courses" class="courses section">

    <!-- ---------| Additional Content |--------- -->
    <div class="container">
      <!-- ---- ROW ---- -->
      <div class="row">
        <!-- ---- Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($rows[0]->title))?></h5>
              <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($rows[0]->category_row->category))?></p>
              <p class="card-text"><?=esc($rows[0]->description)?></p>
            </div>
            <!-- -| ./Card Body\. |- -->

            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS English Tips&comma; your best IELTS guide</h5>
              <p class="card-text">Are you preparing for <strong>IELTS</strong>? Seeking a place where you could find <strong>IELTS</strong> <strong>tips and tricks</strong>? Searching a site with a real-test-like collection of <strong>exam samples</strong>? Learning <strong>IELTS</strong> <strong>vocabulary</strong>? Searching useful <strong>IELTS</strong> <strong>exercises</strong>? Or maybe you are just studying <strong>English</strong>? Then this site is for you.</p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- P1 Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">All you need to succeed in <strong>IELTS</strong> is here!</h5>
              <p class="card-text">Our site is created to prepare you for <strong>IELTS</strong> and improve your <strong>English</strong> efficiently. Whatever your level of <strong>English</strong> is, you can find here everything you need to reach your aim score in <strong>IELTS</strong>!</p>
            </div>
            <!-- -| ./Card Body\. |- -->
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS consists of 4 parts&colon;</h5>
              <p class="card-text">
                <span class="fw-bold">What this course covers</span>
                <ul>
                  <li><strong>IELTS</strong> Listening</li>
                  <li><strong>IELTS</strong> Reading</li>
                  <li><strong>IELTS</strong> Writing</li>
                  <li><strong>IELTS</strong> Speaking</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./P1 Column\. |- -->

        <!-- ---- Features1 Column ---- -->
        <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS Listening&colon;</h5>
              <p class="card-text">
                <ul>
                  <li>About Listening section</li>
                  <li>Listening samples</li>
                  <li>Listening exercises</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
        </div>

        <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS Speaking&colon;</h5>
              <p class="card-text">
                <ul>
                  <li>About Speaking section</li>
                  <li>Speaking samples</li>
                  <li>Speaking vocabulary</li>
                  <li>Speaking test simulator</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Features1 Column\. |- -->

        <!-- ---- Features2 Column ---- -->
        <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS Reading&colon;</h5>
              <p class="card-text">
                <ul>
                  <li>About Reading section</li>
                  <li>Reading samples</li>
                  <li>Reading exercises</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
        </div>

        <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS Writing&colon;</h5>
              <p class="card-text">
                <ul>
                  <li>About Writing section</li>
                  <li>Academic Writing task 1 samples</li>
                  <li>General Writing task 1 samples</li>
                  <li>Writing task 2 samples</li>
                  <li>Writing exercises</li>
                  <li>Writing vocabulary</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Features2 Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">See on this course&colon;</h5>
              <p class="card-text">
                <ul>
                  <li>About IELTS</li>
                  <li>Academic and General IELTS</li>
                  <li>IELTS consists of 4 sections ...</li>
                  <li>IELTS results</li>
                  <li>IELTS scoring</li>
                </ul>
              </p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-8 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">About IELTS&colon;</h5>
              <p class="card-text">IELTS is the International English Language Testing System, the world's most popular English language test.</p>
              <p class="card-text">It is designed to determine the level of English skills of people whose first language is not English. IELTS is the most demanded test of English for study and immigration, being taken by more than 2 million people each year.</p>
              <p class="card-text">IELTS is jointly owned by British Council, IDP: IELTS Australia and Cambridge English Language Assessment through more than 1,000 test centres and locations in over 140 countries.</p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">Academic vs. General&colon;</h5>
              <p class="card-text">There are two versions of IELTS: <strong>Academic</strong> and <strong>General</strong>.</p>
              <ol>
                <li>Certificate of <strong>Academic IELTS</strong> is used for admission to schools, colleges and universities in English-speaking countries.</li>
                <li>The certificate <strong>General Training IELTS</strong> (and sometimes Academic IELTS) is mandatory for all who wish to immigrate to or work in UK, Canada, Australia, USA, New Zealand, etc.</li>
              </ol>
              <p class="card-text">It is advised not to consider a report older than two years to be valid, unless the user proves that he/she has worked to maintain his/her level of English.</p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <p class="card-text">Usually IELTS Academic is conducted once in two weeks and IELTS General once in four weeks.</p>
              <p class="card-text">The total time of IELTS is 2 hours 45 minutes. The listening, reading and writing parts are completed in one sitting in a common exam auditorium, while the speaking part is taken individually with an examiner on the same day or up to week before or after the other tests.</p>
              <p class="card-text">Listening and Speaking modules are the same for Academic and General IELTS, while Reading and Writing modules are different.</p>
              <p class="card-text">All the parts are evaluated on a scale from 0 to 9 points. The <strong>total score</strong> is counted as arithmetic mean of the four section scores.</p>
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS results&colon;</h5>
              <p class="card-text">The results are issued 13 days after the test.</p>
              <p class="card-text">There is no minimum score required to pass IELTS. <strong>IELTS score is evaluated on a scale from 0 to 9 points</strong>. The IELTS certificate is a <strong>Test Report Form</strong>. It is issued to all test takers with a score from "band 1" (non-user) to "band 9" (expert user) and each institution sets a different threshold.</p>
            </div>
            <!-- -| ./Card Body\. |- -->

            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS certificate sample&colon;</h5>
              <img src="<?=ROOT?>/assets/img/cert_big.png" alt="IELTS Certification" class="card-text my-1">
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

        <!-- ---- Column ---- -->
        <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
          <!-- ---- Card ---- -->
          <div class="card border-2 m-4">
            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <p class="card-text">Overall IELTS scores are reported to the nearest half band (you can receive 7.5, 8.0, 8.5 for example).</p>
              <p class="card-text">If the overall score ends in .25, it is rounded up to the next half band (overall 6.25=6.5), and if it ends in .75, it is rounded up to the next whole band (overall 7.75=8.0).</p>
              <p class="card-text">Most top universities require 6.0-7.0 overall IELTS score for admission.</p>
              <p class="card-text">Each IELTS score corresponds to some level of English proficiency. Bands are described as follows</p>
            </div>
            <!-- -| ./Card Body\. |- -->

            <!-- ---- Card Body ---- -->
            <div class="card-body">
              <h5 class="card-title" style="color: #5578ff">IELTS Band score&colon;</h5>
              <img src="<?=ROOT?>/assets/img/ieltsscoring.png" alt="IELTS Band score" class="card-text my-1">
            </div>
            <!-- -| ./Card Body\. |- -->
          </div>
          <!-- -| ./Card\. |- -->
        </div>
        <!-- -| ./Column\. |- -->

      </div>
      <!-- -| ./ROW\. |- -->
    </div>
    <!-- -------| ./Additional Content\. |------- -->

    <div class="container-fluid p-5 bg-light">

      <div class="row">

        <?php if (!empty($rows)): ?>
          <?php foreach ($rows as $row): ?>
            <?php
              $read_more_routes = [
                'ielts-intensive-course' => 'ielts',
                'headway-curriculum' => 'headway',
                'computer-science' => 'computer',
              ];
              $read_more_route = $read_more_routes[$row->slug ?? ''] ?? null;
            ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="course-item">
                <?php if (!empty($row->course_image) && file_exists($row->course_image)): ?>
                  <img src="<?=esc(get_image($row->course_image))?>" class="img-fluid" alt="<?=esc($row->title)?>">
                <?php endif; ?>
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <?php if (!empty($row->category_row->category)): ?>
                      <p class="category"><a href="<?=ROOT?>/course_details/<?=esc($row->slug)?>" class="text-white"><?=esc($row->category_row->category)?></a></p>
                    <?php endif; ?>
                    <?php if (isset($row->price_row->price) && is_numeric($row->price_row->price)): ?>
                      <p class="price">
                        <?php if ((float)$row->price_row->price === 0.0): ?>
                          Free
                        <?php else: ?>
                          <?=esc($row->currency_row->symbol ?? '')?><?=esc($row->price_row->price)?>
                          <?php if (!empty($row->currency_row->currency)): ?>
                            <sup><?=esc($row->currency_row->currency)?></sup>
                          <?php endif; ?>
                        <?php endif; ?>
                      </p>
                    <?php endif; ?>
                  </div>
    
                  <h3><a href="<?=ROOT?>/course_details/<?=esc($row->slug)?>"><?=esc($row->title)?></a></h3>
                  <?php if (!empty($row->subtitle)): ?>
                    <p class="description"><?=esc($row->subtitle)?></p>
                  <?php endif; ?>
                  <p class="description"><?=esc($row->description)?></p>
                  <!-- <?php if ($read_more_route !== null): ?>
                    <a class="read-more" href="<?=ROOT?>/<?=$read_more_route?>">Read more..</a>
                  <?php endif; ?> -->
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12">
            <p class="text-center">No courses are available right now.</p>
          </div>
        <?php endif; ?>

      </div>

    </div>

  </section>
  <!-- -------| ./Courses Section\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>