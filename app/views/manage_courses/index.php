<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php flash('course_message'); ?>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Courses</h2>
            <a href="<?php echo URLROOT; ?>/manage_courses/add" class="btn btn-primary">
              <i class="bi bi-plus-circle me-2"></i>Add Course
            </a>
          </div>
          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Price (EGP)</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['courses'] as $course) : ?>
                  <tr>
                    <td><?php echo $course->title; ?></td>
                    <td><span class="badge bg-info text-dark"><?php echo $course->category; ?></span></td>
                    <td><?php echo $course->price; ?></td>
                    <td>
                      <span class="badge <?php echo ($course->status == 'published') ? 'bg-success' : 'bg-warning'; ?>">
                        <?php echo $course->status; ?>
                      </span>
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="<?php echo URLROOT; ?>/manage_courses/edit/<?php echo $course->id; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="<?php echo URLROOT; ?>/manage_courses/delete/<?php echo $course->id; ?>" method="post" class="d-inline">
                          <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
