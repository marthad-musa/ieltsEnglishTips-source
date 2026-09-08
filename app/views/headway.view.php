<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| ACTION |--------- -->
  <?php if (!empty($rows[1])): ?>
    <!-- ---------| Page Title |--------- -->
    <div class="page-title" data-aos="fade">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?=ROOT?>">Home</a></li>
            <li class="">Course Details</li>
            <li class="current"><?=esc($rows[1]->title)?></li>
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
                <img src="<?=get_image($rows[1]->course_image)?>" alt="<?=esc($rows[1]->title)?>" class="img-fluid">
              </div>
              <div class="course-meta">
                <div class="instructor">
                  <img src="<?=get_image($rows[1]->user_row->image)?>" alt="<?=esc($rows[1]->user_row->name)?>" class="instructor-avatar">
                  <div class="instructor-info">
                    <h6><?=esc($rows[1]->user_row->name)?></h6>
                    <!-- <span><?=esc(ucfirst($uid->job))?></span> -->
                  </div>
                </div>
                <div class="course-stats">
                  <div class="stat-item">
                    <i class="bi bi-people"></i>
                    <span><?=esc($rows[1]->total_student ?: '27')?> students</span>
                  </div>
                  <div class="stat-item">
                    <i class="bi bi-clock"></i>
                    <span><?=esc($rows[1]->course_duration ?: '40')?> weeks</span>
                  </div>
                  <!-- <div class="stat-item">
                    <i class="bi bi-calendar"></i>
                    <span><?=esc($rows[1]->course_duration ?: '12')?> hours</span>
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
                      <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($rows[1]->title))?></h5>
                      <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($rows[1]->category_row->category))?></p>
                      <p class="card-text"><?=esc($rows[1]->description)?></p>
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
                    <span class="currency"><?=esc(ucfirst($rows[1]->title))?></span><br>
                  </div>
                </div>

                <div class="price">
                  <span class="currency"><?=esc($rows[1]->currency_row->symbol)?></span>
                  <span class="amount"><?=esc($rows[1]->price_row->price)?></span>
                  <span class="period"> <?=esc($rows[1]->currency_row->currency)?>/course</span>
                </div>
                <!-- <div class="original-price">£1000</div> -->

                <div class="course-features">
                  <div class="feature">
                    <i class="bi bi-clock"></i>
                    <em>Course Duration</em>
                    <span><?=esc($rows[1]->course_timeline ?: '40')?> hours of content</span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-translate"></i>
                    <em>Course Languge</em>
                    <span><?=esc(ucfirst($rows[1]->language_row->language))?></span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-cast"></i>
                    <em>Course Level</em>
                    <span><?=esc(ucfirst($rows[1]->level_row->level))?></span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-people"></i>
                    <em>Enrolled Students</em>
                    <span><?=esc($rows[1]->total_student ?: '27')?> enrolled</span>
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
    <?=show($rows[1])?>
  <?php endif; ?>
  <!-- -------| ./ACTION\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>