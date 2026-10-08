<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| ACTION |--------- -->
    <?php if (!empty($rows[0])): ?>
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
                      <span><?=esc($rows[0]->active_enrollment_count)?> active students</span>
                    </div>
                    <?php if ($rows[0]->course_duration !== null && $rows[0]->course_duration !== ''): ?>
                      <div class="stat-item">
                        <i class="bi bi-clock"></i>
                        <span><?=esc($rows[0]->course_duration)?> weeks</span>
                      </div>
                    <?php endif; ?>
                    <?php if ($rows[0]->course_timeline !== null && $rows[0]->course_timeline !== ''): ?>
                      <div class="stat-item">
                        <i class="bi bi-calendar"></i>
                        <span><?=esc($rows[0]->course_timeline)?> hours of video/content</span>
                      </div>
                    <?php endif; ?>
                    <div class="stat-item">
                      <i class="bi bi-calendar"></i>
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
                        <h5 class="card-title" style="color: #5578ff"><?=esc(ucfirst($rows[0]->title))?></h5>
                        <p class="card-text">Category&colon;&nbsp;<?=esc(ucfirst($rows[0]->category_row->category))?></p>
                        <p class="card-text"><?=esc($rows[0]->description)?></p>
                      </div>
                      <!-- -| ./Card Body\. |- -->
                    </div>
                    <!-- -| ./Card\. |- -->
                  </div>
                  <!-- -| ./Description Column\. |- -->

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
                    <?php if ($rows[0]->course_duration !== null && $rows[0]->course_duration !== ''): ?>
                      <div class="feature">
                        <i class="bi bi-clock"></i>
                        <em>Course length</em>
                        <span><?=esc($rows[0]->course_duration)?> weeks</span>
                      </div>
                    <?php endif; ?>
                    <?php if ($rows[0]->course_timeline !== null && $rows[0]->course_timeline !== ''): ?>
                      <div class="feature">
                        <i class="bi bi-play-circle"></i>
                        <em>Video/content time</em>
                        <span><?=esc($rows[0]->course_timeline)?> hours</span>
                      </div>
                    <?php endif; ?>
                    <?php if (!empty($rows[0]->start_date)): ?>
                      <div class="feature"><i class="bi bi-calendar-event"></i><em>Starts</em><span><?=esc(get_date($rows[0]->start_date))?></span></div>
                    <?php endif; ?>
                    <?php if (!empty($rows[0]->end_date)): ?>
                      <div class="feature"><i class="bi bi-calendar-check"></i><em>Ends</em><span><?=esc(get_date($rows[0]->end_date))?></span></div>
                    <?php endif; ?>
                    <div class="feature">
                      <i class="bi bi-translate"></i>
                      <em>Course Languge</em>
                      <span><?=esc(ucfirst($rows[0]->language_row->language))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-cast"></i>
                      <em>Course Subcategory</em>
                      <span><?=esc(ucfirst($rows[0]->level_row->level))?></span>
                    </div>
                    <div class="feature">
                      <i class="bi bi-people"></i>
                      <em>Enrolled Students</em>
                      <span><?=esc($rows[0]->active_enrollment_count)?> active learners</span>
                    </div>
                  </div>

                  <button class="btn-enroll">Enroll Now</button>
                  <!-- <button class="btn-preview">Preview Course</button> -->
                </div>
                <!-- End Pricing Card -->

              </div>
              <!-- End Course Sidebar -->

            </div>

          </div>

        </div>

      </section>
      <!-- /Course Details Section -->
    <?php else: ?>
      <?=show($rows[0])?>
    <?php endif; ?>
  <!-- -------| ./ACTION\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>