<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">

  <section class="course-details section">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-8">
          <img src="<?php echo URLROOT; ?>/assets/img/course-1.png" class="img-fluid" alt="">
          <h3><?php echo $data['course']->title; ?></h3>
          <p><?php echo $data['course']->description; ?></p>

          <div class="course-curriculum">
            <h4>Course Curriculum</h4>
            <?php foreach($data['sections'] as $section) : ?>
              <div class="curriculum-section mb-3">
                <div class="section-header p-3 bg-light border">
                  <h5 class="mb-0"><?php echo $section->title; ?></h5>
                </div>
                <ul class="list-group list-group-flush border">
                  <?php foreach($section->lessons as $lesson) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="bi bi-play-circle me-2"></i><?php echo $lesson->title; ?></span>
                      <?php if(isset($_SESSION['user_id'])) : ?>
                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                      <?php else : ?>
                        <span class="badge bg-secondary">Locked</span>
                      <?php endif; ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="course-info d-flex justify-content-between align-items-center border p-3 mb-3">
            <h5>Trainer</h5>
            <p><?php echo $data['course']->teacher_name; ?></p>
          </div>
          <div class="course-info d-flex justify-content-between align-items-center border p-3 mb-3">
            <h5>Course Fee</h5>
            <p><?php echo $data['course']->price; ?> EGP</p>
          </div>
          <a href="<?php echo URLROOT; ?>/enrollments/enroll/<?php echo $data['course']->id; ?>" class="btn btn-primary w-100 p-3">Enroll in this Course</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
