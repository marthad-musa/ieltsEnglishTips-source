<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <h1>Admin Dashboard</h1>
      <div class="d-flex gap-2 my-3">
        <a class="btn btn-primary" href="<?php echo URLROOT; ?>/manage_courses">Manage Courses</a>
      </div>

      <h2 class="h4 mt-4">Pending Enrollments</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>Student</th><th>Course</th><th>Status</th><th>Date</th></tr></thead>
          <tbody>
            <?php foreach (($data['pending_enrollments'] ?? []) as $enrollment) : ?>
              <tr>
                <td><?php echo htmlspecialchars($enrollment->full_name ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($enrollment->title ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($enrollment->status ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($enrollment->enrolled_at ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <h2 class="h4 mt-4">Recent Exam Results</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>Student</th><th>Exam</th><th>Score</th><th>Date</th></tr></thead>
          <tbody>
            <?php foreach (($data['recent_results'] ?? []) as $result) : ?>
              <tr>
                <td><?php echo htmlspecialchars($result->full_name ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($result->exam_title ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars((string) ($result->score ?? ''), ENT_QUOTES, 'UTF-8'); ?> / <?php echo htmlspecialchars((string) ($result->total_points ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($result->taken_at ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
