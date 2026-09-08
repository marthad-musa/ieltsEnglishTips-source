<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<main class="main" id="main">
  <!-- ---------| Page Title |--------- -->
  <div class="pagetitle">
    <h1 class=""><?=$data['title']?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$data['title']?></li>
      </ol>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->
  
  <!-- ---------| Main Content |--------- -->
  <?php if ($uid->role_id == 3): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>

          <?php if (!empty($approved_courses)): ?>
            <div class="row g-3 mb-4">
              <?php foreach ($approved_courses as $course_row): ?>
                <div class="col-md-6 col-xl-4">
                  <div class="card h-100 shadow-sm border-0">
                    <img src="<?=get_image($course_row->course_image)?>" class="card-img-top" alt="<?=esc($course_row->title)?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title mb-0"><?=esc($course_row->title)?></h6>
                        <span class="badge bg-success rounded-pill">Published</span>
                      </div>
                      <p class="text-muted small mb-2"><?=esc($course_row->category_row->category ?? 'General')?></p>
                      <p class="card-text small mb-3"><?=esc($course_row->description ?? 'No description provided.')?></p>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                      <a href="<?=ROOT?>/admin/course-details/<?=esc($course_row->slug)?>" class="btn btn-sm btn-primary">
                        Select Course
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="alert alert-warning">No published courses are available at the moment.</div>
          <?php endif; ?>

          <div id="course-requests-panel" class="mt-4">
            <div class="alert alert-light border">Select a course to review enrollment requests.</div>
          </div>
        </div>
      </div>
    </section>
  <?php elseif ($uid->role_id == 2): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>
  
          <?php if(!empty($rows)): ?>
            <ul class="list-group">
              <?php foreach($rows as $row): ?>
                <li class="list-group-item">
                  <strong><?=esc($row->title)?></strong>
                  <div class="small text-muted"><?=course_status($row)?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php elseif ($uid->role_id == 1): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>

          <?php if (!empty($approved_courses)): ?>
            <div class="row g-3 mb-4">
              <?php foreach ($approved_courses as $course_row): ?>
                <div class="col-md-6 col-xl-4">
                  <div class="card h-100 shadow-sm border-0">
                    <img src="<?=get_image($course_row->course_image)?>" class="card-img-top" alt="<?=esc($course_row->title)?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                      <h6 class="card-title"><?=esc($course_row->title)?></h6>
                      <p class="text-muted small mb-2"><?=esc($course_row->category_row->category ?? 'General')?></p>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                      <a href="<?=ROOT?>/admin/course-details/<?=esc($course_row->slug)?>" class="btn btn-sm btn-outline-primary">Open Course</a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="alert alert-warning">No published courses are currently available.</div>
          <?php endif; ?>

          <div id="student-course-detail" class="mt-4">
            <div class="alert alert-light border">Choose a course to view its content.</div>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($data['title'])?></h5>
  
          <?php if(!empty($rows)): ?>
            <ul class="list-group">
              <?php foreach($rows as $row): ?>
                <li class="list-group-item">
                  <strong><?=esc($row->title)?></strong>
                  <div class="small text-muted"><?=course_status($row)?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- -------| ./Main Content\. |------- -->

</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const panel = document.getElementById('course-requests-panel');
    const studentPanel = document.getElementById('student-course-detail');

    function safeFetch(url, payload) {
      return fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
        body: new URLSearchParams(payload)
      }).then(r => r.json());
    }

    document.querySelectorAll('.select-course-btn').forEach(function (button) {
      button.addEventListener('click', function () {
        const courseId = button.dataset.courseId;
        const payload = {
          ajax: '1',
          action: 'load_course_requests',
          course_id: courseId,
          csrf_code: '<?=($_SESSION['csrf_code'] ?? '')?>'
        };

        panel.innerHTML = '<div class="text-muted">Loading enrollment requests...</div>';
        safeFetch('<?=ROOT?>/admin/lessons', payload).then(function (response) {
          if (response.success) {
            panel.innerHTML = response.html;
            bindRequestForms();
          } else {
            panel.innerHTML = '<div class="alert alert-danger">' + (response.message || 'Unable to load requests.') + '</div>';
          }
        });
      });
    });

    function bindRequestForms() {
      const forms = document.querySelectorAll('.request-status-form');
      forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
          event.preventDefault();
          const courseId = form.dataset.courseId;
          const userId = form.dataset.requestUserId;
          const status = form.querySelector('select[name="status"]').value;

          safeFetch('<?=ROOT?>/admin/lessons', {
            ajax: '1',
            action: 'update_request_status',
            course_id: courseId,
            user_id: userId,
            status: status,
            csrf_code: '<?=($_SESSION['csrf_code'] ?? '')?>'
          }).then(function (response) {
            if (response.success) {
              const eventBtn = form.querySelector('button[type="submit"]');
              eventBtn.textContent = 'Saved';
              setTimeout(function () {
                eventBtn.textContent = 'Save';
              }, 1000);
            }
          });
        });
      });
    }

    if (studentPanel) {
      document.querySelectorAll('.select-course-btn').forEach(function (button) {
        button.addEventListener('click', function () {
          const courseId = button.dataset.courseId;
          studentPanel.innerHTML = '<div class="text-muted">Loading course details...</div>';
          safeFetch('<?=ROOT?>/admin/lessons', {
            ajax: '1',
            action: 'load_student_course',
            course_id: courseId,
            csrf_code: '<?=($_SESSION['csrf_code'] ?? '')?>'
          }).then(function (response) {
            if (response.success) {
              studentPanel.innerHTML = response.html;
            } else {
              studentPanel.innerHTML = '<div class="alert alert-danger">' + (response.message || 'Unable to load course details.') + '</div>';
            }
          });
        });
      });
    }
  });
</script>
<?php $this->view('partials/private.footer',$data) ?>