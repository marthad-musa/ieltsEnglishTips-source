<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| ACTION |--------- -->
  <?php if ($action == '1'): ?>
    <?php if (!empty($row)): ?>
      <!-- ---------| Page Title |--------- -->
      <div class="page-title" data-aos="fade">
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="<?=ROOT?>">Home</a></li>
              <li class="">Course Details</li>
              <li class="current"><?=esc($row->title)?></li>
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
                  <img src="<?=get_image($row->course_image)?>" alt="<?=esc($row->title)?>" class="img-fluid">
                </div>
                <div class="course-meta">
                  <div class="instructor">
                    <img src="<?=get_image($row->user_row->image)?>" alt="<?=esc($row->user_row->name)?>" class="instructor-avatar">
                    <div class="instructor-info">
                      <h6><?=esc($row->user_row->name)?></h6>
                      <span><?=esc(ucfirst($uid->job))?></span>
                    </div>
                  </div>
                  <div class="course-stats">
                    <div class="stat-item">
                      <i class="bi bi-people"></i>
                      <span><?=esc($row->total_student ?: '27')?> students</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-clock"></i>
                      <span><?=esc($row->course_timeline ?: '40')?> weeks</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-calendar"></i>
                      <span><?=esc($row->course_duration ?: '12')?> hours</span>
                    </div>
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
                        <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($row->title))?></h5>
                        <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($row->category_row->category))?></p>
                        <p class="card-text"><?=esc($row->description)?></p>
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
                      <span class="currency"><?=esc(ucfirst($row->title))?></span><br>
                    </div>
                  </div>

                  <div class="price">
                    <span class="currency"><?=esc($row->currency_row->symbol)?></span>
                    <span class="amount"><?=esc($row->price_row->price)?></span>
                    <span class="period"> <?=esc($row->currency_row->currency)?>/course</span>
                  </div>
                  <!-- <div class="original-price">£1000</div> -->

                  <div class="course-features">
                    <div class="feature">
                      <i class="bi bi-clock"></i>
                      <em>Course Duration</em>
                      <span><?=esc($row->course_timeline ?: '40')?> hours of content</span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-translate"></i>
                      <em>Course Languge</em>
                      <span><?=esc(ucfirst($row->language_row->language))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-cast"></i>
                      <em>Course Level</em>
                      <span><?=esc(ucfirst($row->level_row->level))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-people"></i>
                      <em>Enrolled Students</em>
                      <span><?=esc($row->total_student ?: '27')?> enrolled</span>
                    </div>
                  </div>

                  <button class="btn-enroll">Enroll Now</button>
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

  <?php elseif ($action == '2'): ?>
    <?php if (!empty($row)): ?>
      <!-- ---------| Page Title |--------- -->
      <div class="page-title" data-aos="fade">
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="<?=ROOT?>">Home</a></li>
              <li class="">Course Details</li>
              <li class="current"><?=esc($row->title)?></li>
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
                  <img src="<?=get_image($row->course_image)?>" alt="<?=esc($row->title)?>" class="img-fluid">
                </div>
                <div class="course-meta">
                  <div class="instructor">
                    <img src="<?=get_image($row->user_row->image)?>" alt="<?=esc($row->user_row->name)?>" class="instructor-avatar">
                    <div class="instructor-info">
                      <h6><?=esc($row->user_row->name)?></h6>
                      <span><?=esc(ucfirst($uid->job))?></span>
                    </div>
                  </div>
                  <div class="course-stats">
                    <div class="stat-item">
                      <i class="bi bi-people"></i>
                      <span><?=esc($row->total_student ?: '27')?> students</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-clock"></i>
                      <span><?=esc($row->course_timeline ?: '40')?> weeks</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-calendar"></i>
                      <span><?=esc($row->course_duration ?: '12')?> hours</span>
                    </div>
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
                        <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($row->title))?></h5>
                        <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($row->category_row->category))?></p>
                        <p class="card-text"><?=esc($row->description)?></p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Description Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <h5 class="card-title" style="color: #5578ff">Headway</h5>
                        <p class="card-text">Published by <q class="fw-5">Oxford University Press</q> is one of the world’s most popular English language learning series. Created by Liz and John Soars, it is designed for non-native speakers who want to learn English systematically—from absolute beginners to advanced speakers.</p>
                        <p class="card-text">In simple terms, Headway blends clear grammar rules with practical, everyday conversation skills.</p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <h5 class="card-title" style="color: #5578ff">4 Main Pillars of the Headway Approach</h5>
                        <p class="card-text">
                          <ol>
                            <li><em>Strong Grammar Foundation</em>&colon; Unlike courses that rely only on immersive listening, Headway explains how the language works step-by-step so learners understand sentence structure clearly.</li>
                            <li>
                              <em>Integrated Skills</em>&colon; Every unit exercises all four core language skills together&colon;
                              <ul>
                                <li><em>Reading</em>&colon; Articles, real-world stories, and interviews.</li>
                                <li><em>Listening</em>&colon; Audio tracks featuring natural conversations and accents.</li>
                                <li><em>Speaking</em>&colon; Guided pair work, discussions, and role-plays.</li>
                                <li><em>Writing</em>&colon; Email drafting, essay structure, and formal/informal notes.</li>
                              </ul>
                            </li>
                            <li><em><q>Everyday English</q></em>&colon; Focuses on practical phrases used in daily situations (e.g., ordering food, asking for directions, making phone calls).</li>
                            <li><em>Clear Progression</em>&colon; The series is split into standard levels that align with global language standards (CEFR)&colon;</li>
                          </ol>
                        </p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Column\. |- -->

                  <!-- ---- Table1 Column ---- -->
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <!-- <h5 class="card-title" style="color: #5578ff"></h5> -->
                        <p class="card-text">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Level</th>
                                <th scope="col">Target Skill Level</th>
                                <th scope="col">Focus</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Beginner / Elementary</th>
                                <td>A1 – A2</td>
                                <td>Basic greetings, present/past tenses, everyday nouns & verbs</td>
                              </tr>
                              <tr>
                                <th scope="row">Intermediate / Upper-Int</th>
                                <td>B1 – B2</td>
                                <td>Complex tenses, opinions, business/academic context</td>
                              </tr>
                              <tr>
                                <th scope="row">Advanced</th>
                                <td>C1</td>
                                <td>Nuanced vocabulary, idiom usage, formal debates</td>
                              </tr>
                            </tbody>
                          </table>
                        </p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Table1 Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <h5 class="card-title" style="color: #5578ff">Why it's widely used</h5>
                        <p class="card-text">It balances structured rules with interactive speaking activities, making it easy for teachers to follow and predictable for students to track their progress.</p>
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
                        <h5 class="card-title" style="color: #5578ff">Headway Levels</h5>
                        <p class="card-text">The Headway Intermediate level (B1–B2 CEFR) acts as a bridge where learners shift from basic sentence patterns to nuanced, natural-sounding English. It moves away from just memorizing grammar rules to understanding how aspect, time, and speaker attitude alter meaning.</p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Column\. |- -->

                  <!-- ---- Table2 Column ---- -->
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <p class="card-text">Unit-by-Unit Syllabus Breakdown (12 Units) The course is divided into 12 comprehensive units, each balancing core grammar, targeted vocabulary, and real-world communication&colon;</p>
                        <p class="card-text">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Unit</th>
                                <th scope="col">Unit Theme</th>
                                <th scope="col">Key Grammar Focus</th>
                                <th scope="col">Practical / Everyday Focus</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>What's your story&quest;</td>
                                <td>Information questions, auxiliary review, simple vs. continuous present</td>
                                <td>Making small talk, asking personal questions</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Language & Life</td>
                                <td>Tense system review, question tags, state vs. activity verbs</td>
                                <td>Spoken English, polite expressions, phone skills</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Just Good Friends</td>
                                <td>Narrative tenses (Past Simple, Past Continuous, Past Perfect), passive voice in past</td>
                                <td>Retelling stories, expressing opinions</td>
                              </tr>
                              <tr>
                                <th scope="row">4</th>
                                <td>Tales of the Unexpected</td>
                                <td>Modals & related verbs for advice, permission, obligation (must, have to, allowed to)</td>
                                <td>Making polite requests, offers, and giving advice</td>
                              </tr>
                            </tbody>
                          </table>
                        </p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <p class="card-text">
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th scope="row">5</th>
                                <td>Rights and Wrongs</td>
                                <td>Present Perfect (Simple vs. Continuous), for / since, time expressions</td>
                                <td>Expressing numbers, dates, statistics, life changes</td>
                              </tr>
                              <tr>
                                <th scope="row">6</th>
                                <td>Earning a Living</td>
                                <td>Verb patterns: Verb + -ing vs. Verb + infinitive with / without to</td>
                                <td>Job applications, formal emails, negotiating</td>
                              </tr>
                              <tr>
                                <th scope="row">7</th>
                                <td>Best Years of Your Life&quest;</td>
                                <td>Future forms (will, going to, Present Continuous for future, may/might)</td>
                                <td>Discussing arrangements, predictions, future plans</td>
                              </tr>
                              <tr>
                                <th scope="row">8</th>
                                <td>Future Wonders</td>
                                <td>Conditionals (Zero, First, Second, Third), hypotheticals</td>
                                <td>Softening complaints, making suggestions</td>
                              </tr>
                              <tr>
                            </tbody>
                          </table>
                        </p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <p class="card-text">
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th scope="row">9</th>
                                <td>Caring & Sharing</td>
                                <td>Modals of probability in the present & past (must be, can't be, might have been)</td>
                                <td>Describing photos, deducing events from evidence</td>
                              </tr>
                              <tr>
                                <th scope="row">10</th>
                                <td>Beyond Belief</td>
                                <td>Passives in all tenses, have/get something done (causative)</td>
                                <td>Expressing agreement, disagreement, and balance</td>
                              </tr>
                              <tr>
                                <th scope="row">11</th>
                                <td>Back in the Real World</td>
                                <td>Indirect / Reported Speech, reported questions, reporting verbs (deny, urge, offer)</td>
                                <td>Writing formal letters, reporting discussions</td>
                              </tr>
                              <tr>
                                <th scope="row">12</th>
                                <td>Living for the Future</td>
                                <td>Mixed conditionals, revision of complex structures & review</td>
                                <td>Summary writing, formal presentations</td>
                              </tr>
                            </tbody>
                          </table>
                        </p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Table2 Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <h5 class="card-title" style="color: #5578ff">4 Core Pillars of Intermediate Grammar</h5>
                        <p class="card-text"><em>Aspect over Tense</em>&colon; Students learn the difference between Simple (completed actions/habits) and Continuous (temporary/in-progress actions) across present, past, and future contexts.</p>
                        <p class="card-text"><em>Present Perfect vs. Past Simple:</em>&colon; A deep dive into unfinished time vs. finished time, along with the continuous aspect (<q>I've written an email</q> vs. <q>I've been writing emails all morning</q>).</p>
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
                        <p class="card-text"><em>Modals & Nuance</em>&colon; Moving beyond basic rules to express deduction and probability in the past (<q>She must have missed the train</q>).</p>
                        <p class="card-text"><em>Verb Patterns & Dependent Structures</em>&colon; Knowing whether a verb is followed by a gerund (<q>enjoy working</q>) or an infinitive (<q>decide to work</q>)</p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <p class="card-text">If you'd like to hear audio examples and walkthroughs of the listening and grammar tasks from the course, you can check out the Headway Intermediate 5th Edition Audio Workbook. This complete workbook audio collection covers units 1 through 12, giving you a direct look at how these grammar topics are tested in practical listening exercises.</p>
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
                      <span class="currency"><?=esc(ucfirst($row->title))?></span><br>
                    </div>
                  </div>

                  <div class="price">
                    <span class="currency"><?=esc($row->currency_row->symbol)?></span>
                    <span class="amount"><?=esc($row->price_row->price)?></span>
                    <span class="period"> <?=esc($row->currency_row->currency)?>/course</span>
                  </div>
                  <!-- <div class="original-price">£1000</div> -->

                  <div class="course-features">
                    <div class="feature">
                      <i class="bi bi-clock"></i>
                      <em>Course Duration</em>
                      <span><?=esc($row->course_timeline ?: '40')?> hours of content</span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-translate"></i>
                      <em>Course Languge</em>
                      <span><?=esc(ucfirst($row->language_row->language))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-cast"></i>
                      <em>Course Level</em>
                      <span><?=esc(ucfirst($row->level_row->level))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-people"></i>
                      <em>Enrolled Students</em>
                      <span><?=esc($row->total_student ?: '27')?> enrolled</span>
                    </div>
                  </div>

                  <button class="btn-enroll">Enroll Now</button>
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
  <?php elseif ($action == '3'): ?>
    <?php if (!empty($row)): ?>
      <!-- ---------| Page Title |--------- -->
      <div class="page-title" data-aos="fade">
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="<?=ROOT?>">Home</a></li>
              <li class="">Course Details</li>
              <li class="current"><?=esc($row->title)?></li>
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
                  <img src="<?=get_image($row->course_image)?>" alt="<?=esc($row->title)?>" class="img-fluid">
                </div>
                <div class="course-meta">
                  <div class="instructor">
                    <img src="<?=get_image($row->user_row->image)?>" alt="<?=esc($row->user_row->name)?>" class="instructor-avatar">
                    <div class="instructor-info">
                      <h6><?=esc($row->user_row->name)?></h6>
                      <span><?=esc(ucfirst($uid->job))?></span>
                    </div>
                  </div>
                  <div class="course-stats">
                    <div class="stat-item">
                      <i class="bi bi-people"></i>
                      <span><?=esc($row->total_student ?: '27')?> students</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-clock"></i>
                      <span><?=esc($row->course_timeline ?: '40')?> weeks</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-calendar"></i>
                      <span><?=esc($row->course_duration ?: '12')?> hours</span>
                    </div>
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
                        <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($row->title))?></h5>
                        <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($row->category_row->category))?></p>
                        <p class="card-text"><?=esc($row->description)?></p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Description Column\. |- -->

                  <!-- ---- Column ---- -->
                  <div class="col-xl-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                    <!-- ---- Card ---- -->
                    <div class="card border-0">
                      <!-- ---- Card Body ---- -->
                      <div class="card-body">
                        <h5 class="card-title" style="color: #5578ff">What this course covers&colon;</h5>
                        <p class="card-text"></p>
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
                      <span class="currency"><?=esc(ucfirst($row->title))?></span><br>
                    </div>
                  </div>

                  <div class="price">
                    <span class="currency"><?=esc($row->currency_row->symbol)?></span>
                    <span class="amount"><?=esc($row->price_row->price)?></span>
                    <span class="period"> <?=esc($row->currency_row->currency)?>/course</span>
                  </div>
                  <!-- <div class="original-price">£1000</div> -->

                  <div class="course-features">
                    <div class="feature">
                      <i class="bi bi-clock"></i>
                      <em>Course Duration</em>
                      <span><?=esc($row->course_timeline ?: '40')?> hours of content</span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-translate"></i>
                      <em>Course Languge</em>
                      <span><?=esc(ucfirst($row->language_row->language))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-cast"></i>
                      <em>Course Level</em>
                      <span><?=esc(ucfirst($row->level_row->level))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-people"></i>
                      <em>Enrolled Students</em>
                      <span><?=esc($row->total_student ?: '27')?> enrolled</span>
                    </div>
                  </div>

                  <button class="btn-enroll">Enroll Now</button>
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
  <?php else: ?>
    <!-- ---------| Page Title |--------- -->
    <div class="page-title" data-aos="fade">
      <!-- ---------| Hero Section |--------- -->
      <section id="hero" class="hero section dark-background">

        <img src="<?=ROOT?>/assets/img/hero-11.png" alt="" data-aos="fade-in">

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

      <div class="container">

        <div class="row">

          <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="course-item">
                  <img src="<?=get_image($row->course_image)?>" class="img-fluid" alt="<?=esc($row->title)?>">
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <p class="category"><a href="<?=ROOT?>/courses/<?=esc($row->id)?>" class="text-white"><?=esc($row->category_row->category)?></a></p>
                      <p class="price">
                        <?=esc($row->currency_row->symbol)?><?=esc($row->price_row->price)?> <sup><?=esc($row->currency_row->currency)?></sup>
                      </p>
                    </div>
      
                    <h3><a href="#"><?=esc($row->title)?></a></h3>
                    <p class="description"><?=esc($row->description)?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="course-item">
                <img src="./assets/img/course-1.png" class="img-fluid" alt="...">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="category"><a href="<?=ROOT?>/courses/1" class="text-white">IELTS Preparation</a></p>
                    <p class="price">1000 <sup>EGP</sup></p>
                  </div>
    
                  <h3><a href="#">IELTS Intensive Course</a></h3>
                  <p class="description">Boost your score quickly with our intensive preparation course.</p>
                </div>
              </div>
            </div>
            <!-- End Course Item-->
    
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="course-item">
                <img src="./assets/img/course-2.png" class="img-fluid" alt="...">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="category"><a href="<?=ROOT?>/courses/2" class="text-white">English Course</a></p>
                    <p class="price">750 <sup>EGP</sup></p>
                  </div>
    
                  <h3><a href="#">Headway Curriculum</a></h3>
                  <p class="description">Get ready for journey in learining the English language.</p>
                </div>
              </div>
            </div>
            <!-- End Course Item-->
    
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="course-item">
                <img src="./assets/img/course-3.png" class="img-fluid" alt="...">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="category"><a href="<?=ROOT?>/courses/3" class="text-white">I.T</a></p>
                    <p class="price">750 <sup>EGP</sup></p>
                  </div>
    
                  <h3><a href="#">Computer Science</a></h3>
                  <p class="description">Learn how devices work and connect with the rest of the world.</p>
                </div>
              </div>
            </div>
            <!-- End Course Item-->
          <?php endif; ?>

        </div>
  
      </div>

    </section>
    <!-- -------| ./Courses Section\. |------- -->
  <?php endif; ?>
  <!-- -------| ./ACTION\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>