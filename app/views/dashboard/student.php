<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php flash('payment_success'); ?>
          <?php flash('exam_message'); ?>
          <h2>Student Dashboard</h2>
          <p>Welcome back, <?php echo $_SESSION['user_name']; ?></p>
          <hr>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">
              My Enrolled Courses
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php foreach($data['my_enrollments'] as $enrollment) : ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $enrollment->title; ?>
                    <span class="badge bg-success"><?php echo $enrollment->status; ?></span>
                  </li>
                <?php endforeach; ?>
                <?php if(empty($data['my_enrollments'])) : ?>
                  <p>You haven't enrolled in any courses yet.</p>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-info text-white">
              My Exam Results
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php foreach($data['my_results'] as $result) : ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $result->title; ?>
                    <span class="badge bg-primary"><?php echo $result->score; ?> / <?php echo $result->total_points; ?></span>
                  </li>
                <?php endforeach; ?>
                <?php if(empty($data['my_results'])) : ?>
                  <p>No exam results found.</p>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
