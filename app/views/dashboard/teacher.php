<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Teacher Dashboard</h2>
          <p>Welcome, <?php echo $_SESSION['user_name']; ?></p>
          <hr>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-primary text-white">
              Course Management
            </div>
            <div class="card-body">
              <p>You have <?php echo count($data['my_courses']); ?> courses.</p>
              <a href="<?php echo URLROOT; ?>/manage_courses" class="btn btn-primary">Manage My Courses</a>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-info text-white">
              Student Performance Report
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Student</th>
                      <th>Exam</th>
                      <th>Score</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['student_performance'] as $result) : ?>
                      <tr>
                        <td><?php echo $result->full_name; ?></td>
                        <td><?php echo $result->title; ?></td>
                        <td><?php echo $result->score; ?> / <?php echo $result->total_points; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($result->taken_at)); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
