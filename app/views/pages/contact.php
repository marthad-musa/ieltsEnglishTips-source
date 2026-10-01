<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <h1><?php echo htmlspecialchars($data['title'] ?? 'Contact Us', ENT_QUOTES, 'UTF-8'); ?></h1>
      <p>For course information, visit the courses page. Account holders can sign in to access their dashboard and course services.</p>
      <a class="btn btn-primary" href="<?php echo URLROOT; ?>/courses">Browse Courses</a>
      <a class="btn btn-outline-primary" href="<?php echo URLROOT; ?>/users/login">Sign In</a>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
