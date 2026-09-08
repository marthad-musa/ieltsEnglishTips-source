<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| ACTION |--------- -->
  <?php if (!empty($rows)): ?>
    <!-- ---------| Page Title |--------- -->
    <div class="page-title" data-aos="fade">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?=ROOT?>">Home</a></li>
            <li class="">Course Details</li>
            <li class="current"><?=esc($rows[0]->title)?></li>
          </ol>
        </div>
      </nav>
    </div>
    <!-- -------| ./Page Title\. |------- -->

    <!-- Course Details Section -->
    <section id="course-details" class="course-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8">

            <!-- Course Header -->
            <div class="course-header" data-aos="fade-up" data-aos-delay="200">
              <div class="course-image">
                <img src="<?=get_image($rows[0]->course_image)?>" alt="<?=esc($rows[0]->title)?>" class="img-fluid">
              </div>
              <div class="course-meta">
                <div class="instructor">
                  <img src="<?=get_image($rows[0]->user_row->image)?>" alt="<?=esc($rows[0]->user_row->name)?>" class="instructor-avatar">
                  <div class="instructor-info">
                    <h6><?=esc($rows[0]->user_row->name)?></h6>
                    <!-- <span><?=esc(ucfirst($uid->job))?></span> -->
                  </div>
                </div>
                <div class="course-stats">
                  <div class="stat-item">
                    <i class="bi bi-people"></i>
                    <span><?=esc($rows[0]->total_student ?: '27')?> students</span>
                  </div>
                  <div class="stat-item">
                    <i class="bi bi-clock"></i>
                    <span><?=esc($rows[0]->course_duration ?: '40')?> weeks</span>
                  </div>
                  <!-- <div class="stat-item">
                    <i class="bi bi-calendar"></i>
                    <span><?=esc($rows[0]->course_duration ?: '12')?> hours</span>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- End Course Header -->

            <!-- ---------| Additional Content |--------- -->
            <div class="container">
              <!-- ---- ROW ---- -->
              <div class="row">
                <!-- ---- Description Column ---- -->
                <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($rows[0]->title))?></h5>
                      <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($rows[0]->category_row->category))?></p>
                      <p class="card-text"><?=esc($rows[0]->description)?></p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Description Column\. |- -->

                <!-- ---- Intro Column ---- -->
                <div class="col-xl-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff">IELTS English Tips&comma; your best IELTS guide</h5>
                      <p class="card-text">Are you preparing for <strong>IELTS</strong>? Seeking a place where you could find <strong>IELTS</strong> <strong>tips and tricks</strong>? Searching a site with a real-test-like collection of <strong>exam samples</strong>? Learning <strong>IELTS</strong> <strong>vocabulary</strong>? Searching useful <strong>IELTS</strong> <strong>exercises</strong>? Or maybe you are just studying <strong>English</strong>? Then this site is for you.</p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Intro Column\. |- -->

                <!-- ---- P1 Column ---- -->
                <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff">All you need to succeed in <strong>IELTS</strong> is here!</h5>
                      <p class="card-text">Our site is created to prepare you for <strong>IELTS</strong> and improve your <strong>English</strong> efficiently. Whatever your level of <strong>English</strong> is, you can find here everything you need to reach your aim score in <strong>IELTS</strong>!</p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff">What this course covers&colon;</h5>
                      <p class="card-text">
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
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
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
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
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
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
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
                      <h5 class="card-title" style="color: #5578ff">About IELTS&colon;</h5>
                      <p class="card-text">IELTS is the International English Language Testing System, the world's most popular English language test.</p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Column\. |- -->

                <!-- ---- Column ---- -->
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
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
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff">Academic vs. General&colon;</h5>
                      <p class="card-text">There are two versions of IELTS: <strong>Academic</strong> and <strong>General</strong>.</p>
                      <ol>
                        <li>Certificate of <strong>Academic IELTS</strong> is used for admission to schools, colleges and universities in English-speaking countries.</li>
                        <li>The certificate <strong>General Training IELTS</strong> (and sometimes Academic IELTS) is mandatory for all who wish to immigrate to or work in UK, Canada, Australia, USA, New Zealand, etc.</li>
                      </ol>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Column\. |- -->

                <!-- ---- Column ---- -->
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <p class="card-text">It is advised not to consider a report older than two years to be valid, unless the user proves that he/she has worked to maintain his/her level of English.</p>
                      <p class="card-text">Usually IELTS Academic is conducted once in two weeks and IELTS General once in four weeks.</p>
                      <h5 class="card-title" style="color: #5578ff">IELTS consists of 4 parts&colon;</h5>
                      <p class="card-text">
                        <ol>
                          <li>Listening</li>
                          <li>Reading</li>
                          <li>Writing</li>
                          <li>Speaking</li>
                        </ol>
                      </p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Column\. |- -->

                <!-- ---- Column ---- -->
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
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
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <h5 class="card-title" style="color: #5578ff">IELTS results&colon;</h5>
                      <p class="card-text">The results are issued 13 days after the test.</p>
                      <p class="card-text">There is no minimum score required to pass IELTS. <strong>IELTS score is evaluated on a scale from 0 to 9 points</strong>. The IELTS certificate is a <strong>Test Report Form</strong>. It is issued to all test takers with a score from "band 1" (non-user) to "band 9" (expert user) and each institution sets a different threshold.</p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Column\. |- -->

                <!-- ---- Column ---- -->
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
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
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
                    <!-- ---- Card Body ---- -->
                    <div class="card-body">
                      <p class="card-text">Overall IELTS scores are reported to the nearest half band (you can receive 7.5, 8.0, 8.5 for example).</p>
                      <p class="card-text">If the overall score ends in .25, it is rounded up to the next half band (overall 6.25=6.5), and if it ends in .75, it is rounded up to the next whole band (overall 7.75=8.0).</p>
                      <p class="card-text">Most top universities require 6.0-7.0 overall IELTS score for admission.</p>
                      <p class="card-text">Each IELTS score corresponds to some level of English proficiency. Bands are described as follows</p>
                    </div>
                    <!-- -| ./Card Body\. |- -->
                  </div>
                  <!-- -| ./Card\. |- -->
                </div>
                <!-- -| ./Column\. |- -->

                <!-- ---- Column ---- -->
                <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <!-- ---- Card ---- -->
                  <div class="card border-0">
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

          </div>

          <div class="col-lg-4">

            <!-- Course Sidebar -->
            <div class="course-sidebar" data-aos="fade-up" data-aos-delay="200">

              <!-- Pricing Card -->
              <div class="pricing-card">
                <div class="price">
                  <div class="feature">
                    <span class="currency"><?=esc(ucfirst($rows[0]->title))?></span><br>
                  </div>
                </div>

                <div class="price">
                  <span class="currency"><?=esc($rows[0]->currency_row->symbol)?></span>
                  <span class="amount"><?=esc($rows[0]->price_row->price)?></span>
                  <span class="period"> <?=esc($rows[0]->currency_row->currency)?>/course</span>
                </div>
                <!-- <div class="original-price">£1000</div> -->

                <div class="course-features">
                  <div class="feature">
                    <i class="bi bi-clock"></i>
                    <em>Course Duration</em>
                    <span><?=esc($rows[0]->course_timeline ?: '40')?> hours of content</span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-translate"></i>
                    <em>Course Languge</em>
                    <span><?=esc(ucfirst($rows[0]->language_row->language))?></span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-cast"></i>
                    <em>Course Level</em>
                    <span><?=esc(ucfirst($rows[0]->level_row->level))?></span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-people"></i>
                    <em>Enrolled Students</em>
                    <span><?=esc($rows[0]->total_student ?: '27')?> enrolled</span>
                  </div>
                </div>

                <a href="<?=ROOT?>/login" class=""><button class="btn-enroll">Enroll Now</button></a>
                <!-- <button class="btn-preview">Preview Course</button> -->
              </div>
              <!-- End Pricing Card -->

              <!-- Course Info -->
              <!-- <div class="course-info-card">
                <h4>Course Information</h4>
                <div class="info-item">
                  <span class="label">Level:</span>
                  <span class="value"></span>
                </div>
                <div class="info-item">
                  <span class="label">Students:</span>
                  <span class="value"></span>
                </div>
                <div class="info-item">
                  <span class="label">Language:</span>
                  <span class="value"></span>
                </div>
                <div class="info-item">
                  <span class="label">Prerequisites:</span>
                  <span class="value">Basic English</span>
                </div>
              </div> -->
              <!-- End Course Info -->

              <!-- Tags -->
              <!-- <div class="course-tags">
                <h4>Tags</h4>
                <div class="tags-list">
                  <span class="tag">English</span>
                  <span class="tag">IELTS</span>
                  <span class="tag">IELTS Speaking TEST</span>
                </div>
              </div> -->
              <!-- End Tags -->

            </div>
            <!-- End Course Sidebar -->

          </div>

        </div>

      </div>

    </section>
    <!-- /Course Details Section -->
  <?php else: ?>
    <?=show($row)?>
  <?php endif; ?>

  <!-- -------| ./ACTION\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>