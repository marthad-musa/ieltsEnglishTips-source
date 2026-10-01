<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <h1><?php echo htmlspecialchars($data['title'] ?? 'About Us', ENT_QUOTES, 'UTF-8'); ?></h1>
      <p>IELTS English Tips provides learning resources and courses to help learners build their English skills and prepare for IELTS.</p>
      <p>Explore the available courses to find a path that fits your learning goals.</p>
      <a class="btn btn-primary" href="<?php echo URLROOT; ?>/courses">Browse Courses</a>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
