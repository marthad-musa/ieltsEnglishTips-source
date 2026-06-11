<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">

  <section id="courses" class="courses section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Courses</h2>
      <p>Popular Courses</p>
    </div>

    <div class="container">
      <div class="row" id="courses-container">
        <!-- Courses will be loaded here via AJAX -->
      </div>
    </div>
  </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('<?php echo URLROOT; ?>/courses/get_courses_ajax')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('courses-container');
        data.forEach(course => {
            const courseHtml = `
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in">
                  <div class="course-item">
                    <img src="${course.thumbnail ? '<?php echo URLROOT; ?>/public/uploads/' + course.thumbnail : '<?php echo URLROOT; ?>/assets/img/course-1.png'}" class="img-fluid" alt="...">
                    <div class="course-content">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="category">${course.category}</p>
                        <p class="price">${course.price} <sup>EGP</sup></p>
                      </div>
                      <h3><a href="<?php echo URLROOT; ?>/courses/show/${course.id}">${course.title}</a></h3>
                      <p class="description">${course.description.substring(0, 100)}...</p>
                      <div class="trainer d-flex justify-content-between align-items-center">
                        <div class="trainer-profile d-flex align-items-center">
                          <span class="trainer-link">${course.teacher_name}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', courseHtml);
        });
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
