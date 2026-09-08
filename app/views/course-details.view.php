<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-3.png" alt="" data-aos="fade-in">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Course Details</h2>
        <p data-aos="fade-up" data-aos-delay="200">Find out more deteails about this course.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Course Details<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <?php if (message()): ?>
    <div class="container mb-4">
      <div class="alert alert-info text-center" role="alert">
        <?=esc(message('', true))?>
      </div>
    </div>
  <?php endif; ?>

  <!-- Course Details Section -->
  <section id="course-details" class="course-details section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-lg-8">

          <!-- Course Header -->
          <div class="course-header" data-aos="fade-up" data-aos-delay="200">
            <div class="course-image">
              <img src="<?=ROOT?>/assets/img/slide-1.jpg" alt="Course Image" class="img-fluid">
            </div>
            <div class="course-meta">
              <div class="instructor">
                <img src="<?=ROOT?>/assets/img/teachers-3.png" alt="Instructor" class="instructor-avatar">
                <div class="instructor-info">
                  <h6>Mohammed Abbo</h6>
                  <span>Founder of <strong style="color: crimson;">IELTS</strong> <strong style="color: #5578ff;">English</strong> <strong style="color: orangered;">Tips</strong></span>
                </div>
              </div>
              <div class="course-stats">
                <div class="stat-item">
                  <i class="bi bi-people"></i>
                  <span><?=esc($course_students ?: '0')?> students</span>
                </div>
                <div class="stat-item">
                  <i class="bi bi-clock"></i>
                  <span>40 hours</span>
                </div>
                <div class="stat-item">
                  <i class="bi bi-calendar"></i>
                  <span>12 weeks</span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Course Header -->

          <!-- Course Sections -->
          <div class="course-curriculum mt-4" data-aos="fade-up" data-aos-delay="300">
            <h3>Course Sections</h3>

            <?php
              $course_sections = array_filter($coursesMeta ?? [], function ($section) {
                return ($section->data_type ?? '') === 'curriculum';
              });
            ?>

            <?php if (!empty($course_sections)): ?>
              <?php foreach ($course_sections as $section): ?>
                <div class="curriculum-section mb-3">
                  <div class="section-header">
                    <h4><?=esc($section->value ?? 'Untitled section')?></h4>
                  </div>

                  <?php
                    $lectures = array_filter($section->lectures_row ?? [], function ($lecture) {
                      return (int)($lecture->disabled ?? 0) === 0;
                    });
                  ?>

                  <?php if (!empty($lectures)): ?>
                    <div class="lessons">
                      <?php foreach ($lectures as $lecture): ?>
                        <div class="lesson-item">
                          <div class="lesson-info">
                            <i class="bi bi-play-circle"></i>
                            <span><?=esc($lecture->title)?></span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <p class="text-muted mb-0">No lectures in this section yet.</p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">No course sections available yet.</p>
            <?php endif; ?>
          </div>
          <!-- End Course Sections -->

          <!-- Course Content -->
          <!-- <div class="course-content" data-aos="fade-up" data-aos-delay="300">
            <h2>IELTS Speaking Test</h2>

            <div class="course-description">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="what-you-learn">
              <h3>What You'll Learn</h3>
              <div class="row">
                <div class="col-md-6">
                  <ul class="learn-list">
                    <li><i class="bi bi-check-circle"></i>Modern JavaScript fundamentals and ES6+ features</li>
                    <li><i class="bi bi-check-circle"></i>React.js component-based development</li>
                    <li><i class="bi bi-check-circle"></i>Node.js backend development essentials</li>
                    <li><i class="bi bi-check-circle"></i>Database design and MongoDB integration</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul class="learn-list">
                    <li><i class="bi bi-check-circle"></i>RESTful API development and testing</li>
                    <li><i class="bi bi-check-circle"></i>Authentication and security best practices</li>
                    <li><i class="bi bi-check-circle"></i>Deployment strategies and DevOps basics</li>
                    <li><i class="bi bi-check-circle"></i>Version control with Git and collaboration</li>
                  </ul>
                </div>
              </div>
            </div>

          </div> -->
          <!-- End Course Content -->

          <!-- Course Curriculum -->
          <!-- <div class="course-curriculum" data-aos="fade-up" data-aos-delay="400">
            <h3>Course Curriculum</h3>

            <div class="curriculum-section">
              <div class="section-header">
                <h4>Module 1: Introduction to Modern Web Development</h4>
                <span class="lessons-count">6 lessons • 3 hours</span>
              </div>
              <div class="lessons">
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>Setting up the Development Environment</span>
                  </div>
                  <span class="lesson-duration">18 min</span>
                </div>
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>JavaScript Fundamentals Review</span>
                  </div>
                  <span class="lesson-duration">25 min</span>
                </div>
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-file-text"></i>
                    <span>Understanding Modern Development Tools</span>
                  </div>
                  <span class="lesson-duration">32 min</span>
                </div>
              </div>
            </div>

            <div class="curriculum-section">
              <div class="section-header">
                <h4>Module 2: React.js Fundamentals</h4>
                <span class="lessons-count">8 lessons • 5 hours</span>
              </div>
              <div class="lessons">
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>Component Architecture and JSX</span>
                  </div>
                  <span class="lesson-duration">28 min</span>
                </div>
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>State Management and Props</span>
                  </div>
                  <span class="lesson-duration">35 min</span>
                </div>
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-file-text"></i>
                    <span>Handling Events and Forms</span>
                  </div>
                  <span class="lesson-duration">42 min</span>
                </div>
              </div>
            </div>

            <div class="curriculum-section">
              <div class="section-header">
                <h4>Module 3: Backend Development with Node.js</h4>
                <span class="lessons-count">10 lessons • 6 hours</span>
              </div>
              <div class="lessons">
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>Setting up Express.js Server</span>
                  </div>
                  <span class="lesson-duration">22 min</span>
                </div>
                <div class="lesson-item">
                  <div class="lesson-info">
                    <i class="bi bi-play-circle"></i>
                    <span>Creating RESTful APIs</span>
                  </div>
                  <span class="lesson-duration">45 min</span>
                </div>
              </div>
            </div>

          </div> -->
          <!-- End Course Curriculum -->

        </div>

        <div class="col-lg-4">

          <!-- Course Sidebar -->
          <div class="course-sidebar" data-aos="fade-up" data-aos-delay="200">

            <!-- Pricing Card -->
            <div class="pricing-card">
              <div class="price">
                <span class="currency">£</span>
                <span class="amount">750</span>
                <span class="period">/course</span>
              </div>
              <div class="original-price">£1000</div>

              <div class="course-features">
                <div class="feature">
                  <i class="bi bi-clock"></i>
                  <span>40 hours of content</span>
                </div>
                <!-- <div class="feature">
                  <i class="bi bi-trophy"></i>
                  <span>Certificate of completion</span>
                </div> -->
                <div class="feature">
                  <i class="bi bi-phone"></i>
                  <span>Mobile and desktop access</span>
                </div>
                <!-- <div class="feature">
                  <i class="bi bi-infinity"></i>
                  <span>Lifetime access</span>
                </div> -->
              </div>

              <form method="post" action="<?=ROOT?>/course_details/enroll/<?=esc($row->slug)?>">
                <?php csrf() ?>
                <button type="submit" class="btn-enroll">Enroll Now</button>
              </form>
              <button class="btn-preview">Preview Course</button>
            </div>
            <!-- End Pricing Card -->

            <!-- Course Info -->
            <div class="course-info-card">
              <h4>Course Information</h4>
              <div class="info-item">
                <span class="label">Level:</span>
                <span class="value">Intermediate</span>
              </div>
              <div class="info-item">
                <span class="label">Students:</span>
                <span class="value">27 enrolled</span>
              </div>
              <div class="info-item">
                <span class="label">Language:</span>
                <span class="value">English</span>
              </div>
              <div class="info-item">
                <span class="label">Prerequisites:</span>
                <span class="value">Basic English</span>
              </div>
              <div class="info-item">
                <span class="label">Last Updated:</span>
                <span class="value">November 2025</span>
              </div>
            </div>
            <!-- End Course Info -->

            <!-- Tags -->
            <div class="course-tags">
              <h4>Tags</h4>
              <div class="tags-list">
                <span class="tag">English</span>
                <span class="tag">IELTS</span>
                <span class="tag">IELTS Speaking TEST</span>
              </div>
            </div><!-- End Tags -->

          </div>
          <!-- End Course Sidebar -->

        </div>

      </div>

    </div>

  </section><!-- /Course Details Section -->

  <!-- Tabs Section -->
  <!-- <section id="tabs" class="tabs section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-lg-3">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Modi sit est</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Unde praesentium sed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Pariatur explicabo vel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Nostrum qui quasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Iusto ut expedita aut</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-9 mt-4 mt-lg-0">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Architecto ut aperiam autem id</h3>
                  <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                  <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="<?=ROOT?>/assets/img/illustration/illustration-13.webp" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-2">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Et blanditiis nemo veritatis excepturi</h3>
                  <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                  <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="<?=ROOT?>/assets/img/illustration/illustration-11.webp" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-3">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                  <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                  <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="<?=ROOT?>/assets/img/illustration/illustration-14.webp" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-4">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                  <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                  <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="<?=ROOT?>/assets/img/illustration/illustration-12.webp" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-5">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                  <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                  <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="<?=ROOT?>/assets/img/illustration/illustration-10.webp" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section> -->
  <!-- /Tabs Section -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>