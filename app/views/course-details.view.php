<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<?php
  $course_image = !empty($row->course_image) && file_exists($row->course_image)
    ? get_image($row->course_image)
    : null;
  $hero_image = !empty($row->hero_background_image) && file_exists($row->hero_background_image)
    ? get_image($row->hero_background_image)
    : ROOT . '/assets/img/hero-3.png';
  $promo_video = !empty($row->course_promo_video) && file_exists($row->course_promo_video)
    ? get_video($row->course_promo_video)
    : null;
  $course_tags = !empty($row->tags)
    ? array_filter(array_map('trim', explode(',', $row->tags)))
    : [];
?>

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=esc($hero_image)?>" alt="" data-aos="fade-in" class="opacity-50">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100"><?=esc($row->title)?></h2>
        <?php if (!empty($row->subtitle)): ?>
          <p data-aos="fade-up" data-aos-delay="200"><?=esc($row->subtitle)?></p>
        <?php endif; ?>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current"><?=esc($row->title)?></li>
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
            <?php if ($course_image): ?>
              <div class="course-image">
                <img src="<?=esc($course_image)?>" alt="<?=esc($row->title)?>" class="img-fluid">
              </div>
            <?php endif; ?>
            <div class="course-meta">
              <?php if (!empty($row->user_row->name)): ?>
                <div class="instructor">
                  <?php if (!empty($row->user_row->image)): ?>
                    <img src="<?=esc(get_image($row->user_row->image))?>" alt="<?=esc($row->user_row->name)?>" class="instructor-avatar">
                  <?php endif; ?>
                  <div class="instructor-info">
                    <h6><?=esc($row->user_row->name)?></h6>
                    <span>Course instructor</span>
                  </div>
                </div>
              <?php endif; ?>
              <div class="course-stats">
                <?php if (!empty($row->course_duration)): ?>
                  <div class="stat-item">
                    <i class="bi bi-calendar"></i>
                    <span><?=esc($row->course_duration)?> <?=((int)$row->course_duration === 1) ? 'week' : 'weeks'?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- End Course Header -->

          <?php if ($promo_video): ?>
            <div class="course-content mb-4" data-aos="fade-up" data-aos-delay="250">
              <h3>Course preview</h3>
              <video controls preload="metadata" class="w-100" style="max-height: 420px;">
                <source src="<?=esc($promo_video)?>" type="video/mp4">
                Your browser does not support video playback.
              </video>
            </div>
          <?php endif; ?>

          <?php if (!empty($row->primary_subject) || !empty($row->category_row->category)): ?>
            <div class="course-content" data-aos="fade-up" data-aos-delay="275">
              <h2>About this course</h2>
              <?php if (!empty($row->primary_subject) || !empty($row->category_row->category)): ?>
                <div class="course-tags">
                  <div class="tags-list">
                    <?php if (!empty($row->primary_subject)): ?>
                      <span class="tag"><?=esc($row->primary_subject)?></span>
                    <?php endif; ?>
                    <?php if (!empty($row->category_row->category)): ?>
                      <span class="tag"><?=esc($row->category_row->category)?></span>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php
            $intended_learner_items = array_filter($coursesMeta ?? [], function ($item) {
              return ($item->tab ?? '') === 'intended-learners'
                && (int)($item->disabled ?? 0) === 0
                && !empty(trim($item->value ?? ''));
            });
            $learning_outcomes = array_values(array_filter($intended_learner_items, function ($item) {
              return ($item->data_type ?? '') === 'students-learn';
            }));
            $course_prerequisites = array_values(array_filter($intended_learner_items, function ($item) {
              return ($item->data_type ?? '') === 'prerequisites';
            }));
            $target_audience = array_values(array_filter($intended_learner_items, function ($item) {
              return ($item->data_type ?? '') === 'description';
            }));
          ?>

          <?php if ($learning_outcomes || $course_prerequisites || $target_audience): ?>
            <div class="course-content intended-learners-content" data-aos="fade-up" data-aos-delay="290">
              <?php if ($learning_outcomes): ?>
                <div class="what-you-learn mb-4">
                  <h3>What you’ll learn</h3>
                  <ul class="learn-list list-unstyled">
                    <?php foreach ($learning_outcomes as $outcome): ?>
                      <li><i class="bi bi-check-circle" aria-hidden="true"></i> <?=esc($outcome->value)?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <?php if ($course_prerequisites): ?>
                <div class="course-prerequisites mb-4">
                  <h3>Prerequisites</h3>
                  <ul>
                    <?php foreach ($course_prerequisites as $prerequisite): ?>
                      <li><?=esc($prerequisite->value)?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <?php if ($target_audience): ?>
                <div class="course-target-audience mb-4">
                  <h3>Who this course is for</h3>
                  <ul>
                    <?php foreach ($target_audience as $audience_item): ?>
                      <li><?=esc($audience_item->value)?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

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
                  <?php if (!empty($section->description)): ?>
                    <p class="section-description"><?=nl2br(esc($section->description))?></p>
                  <?php endif; ?>

                  <?php
                    $lectures = array_filter($section->lectures_row ?? [], function ($lecture) {
                      return (int)($lecture->disabled ?? 0) === 0;
                    });
                  ?>

                  <?php if (!empty($lectures)): ?>
                    <div class="lessons">
                      <?php foreach ($lectures as $lecture): ?>
                        <?php
                          $item_type = $lecture->item_type ?? 'video';
                          $item_type_labels = [
                            'video' => 'Video lesson',
                            'reading' => 'Reading',
                            'quiz' => 'Quiz',
                            'assignment' => 'Assignment',
                          ];
                          $item_type_label = $item_type_labels[$item_type] ?? 'Course item';
                          $is_preview = (int)($lecture->is_preview ?? 0) === 1;
                          $lesson_file = $is_preview && !empty($lecture->file) ? get_video($lecture->file) : '';
                        ?>
                        <div class="lesson-item curriculum-item">
                          <div class="lesson-info">
                            <i class="bi <?=$item_type === 'video' ? 'bi-play-circle' : 'bi-file-text'?>" aria-hidden="true"></i>
                            <div>
                              <strong><?=esc($lecture->title)?></strong>
                              <?php if ($is_preview && !empty($lecture->description)): ?>
                                <p class="mb-1"><?=nl2br(esc($lecture->description))?></p>
                              <?php endif; ?>
                              <small class="text-muted">
                                <?=esc($item_type_label)?>
                                <?php if (!empty($lecture->duration_minutes)): ?>
                                  &middot; <?=esc($lecture->duration_minutes)?> min
                                <?php endif; ?>
                              </small>
                            </div>
                          </div>
                          <?php if ($is_preview): ?>
                            <span class="badge bg-success">Preview</span>
                            <?php if ($item_type === 'video' && $lesson_file): ?>
                              <video class="w-100 mt-2" controls preload="none">
                                <source src="<?=esc($lesson_file)?>" type="video/mp4">
                                Your browser does not support video playback.
                              </video>
                            <?php elseif (!empty($lecture->file)): ?>
                              <a class="btn btn-sm btn-outline-primary mt-2" href="<?=esc(get_video($lecture->file))?>" target="_blank" rel="noopener">Open preview material</a>
                            <?php endif; ?>
                          <?php else: ?>
                            <span class="text-muted"><i class="bi bi-lock" aria-hidden="true"></i> Enrolled learners</span>
                          <?php endif; ?>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <p class="text-muted mb-0">No curriculum items in this section yet.</p>
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
              <h3 class="course-pricing-title text-primary fontAlido"><?=esc($row->title)?></h3>
              <?php if (!empty($row->description)): ?>
                <p class="course-pricing-description"><?=nl2br(esc($row->description))?></p>
              <?php endif; ?>
              <?php if (isset($row->price_row->price) && is_numeric($row->price_row->price)): ?>
                <div class="price">
                  <?php if ((float)$row->price_row->price === 0.0): ?>
                    <span class="amount">Free</span>
                  <?php else: ?>
                    <?php if (!empty($row->currency_row->symbol)): ?>
                      <span class="currency"><?=esc($row->currency_row->symbol)?></span>
                    <?php endif; ?>
                    <span class="amount"><?=esc($row->price_row->price)?></span>
                  <?php endif; ?>
                  <span class="period">/course</span>
                </div>
              <?php endif; ?>

              <form method="post" action="<?=ROOT?>/course_details/enroll/<?=esc($row->slug)?>">
                <?php csrf() ?>
                <button type="submit" class="btn-enroll">Enroll Now</button>
              </form>
            </div>
            <!-- End Pricing Card -->

            <!-- Course Info -->
            <?php if (!empty($row->category_row->category) || !empty($row->primary_subject) || !empty($row->sub_category_row->level) || !empty($row->language_row->language)): ?>
            <div class="course-info-card">
              <h4 class="fontClarity text-primary fs-4">Course Information</h4>
              <?php if (!empty($row->category_row->category)): ?>
                <div class="info-item">
                  <span class="label">Category:</span>
                  <span class="value"><?=esc($row->category_row->category)?></span>
                </div>
              <?php endif; ?>
              <?php if (!empty($row->primary_subject)): ?>
                <div class="info-item">
                  <span class="label">Subject:</span>
                  <span class="value"><?=esc($row->primary_subject)?></span>
                </div>
              <?php endif; ?>
              <?php if (!empty($row->sub_category_row->level)): ?>
                <div class="info-item">
                  <span class="label">Subcategory:</span>
                  <span class="value"><?=esc($row->sub_category_row->level)?></span>
                </div>
              <?php endif; ?>
              <?php if (!empty($row->language_row->language)): ?>
                <div class="info-item">
                  <span class="label">Language:</span>
                  <span class="value"><?=esc($row->language_row->language)?></span>
                </div>
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <!-- End Course Info -->

            <?php if (!empty($course_tags)): ?>
              <div class="course-tags">
                <h4>Tags</h4>
                <div class="tags-list">
                  <?php foreach ($course_tags as $tag): ?>
                    <span class="tag"><?=esc($tag)?></span>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

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