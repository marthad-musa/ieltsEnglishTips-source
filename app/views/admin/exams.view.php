<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<main class="main" id="main">
  <div class="pagetitle">
    <h1><?php echo $data['title']; ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
        <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><?= $data['title'] ?></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-12">

        <!-- Admin View: Pending Exams for Approval -->
        <?php if ($uid->role_id == 3 && !empty($data['pending_exams'])): ?>
          <div class="card mb-4">
            <div class="card-header bg-danger text-white">
              <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Pending Exam Approvals</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>Exam Title</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data['pending_exams'] as $exam): ?>
                      <tr>
                        <td><?= htmlspecialchars($exam->exam_title) ?></td>
                        <td><?= htmlspecialchars($exam->created_by) ?></td>
                        <td><?= $exam->exam_created_on ?></td>
                        <td>
                          <button class="btn btn-sm btn-outline-success publish-exam" data-exam-id="<?= $exam->id ?>">
                            <i class="bi bi-check-circle"></i> Publish
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Add Action: New Exam -->
        <?php if ($data['action'] == 'add'): ?>
          <div class="card">
            <div class="card-header">
              <h5><i class="bi bi-plus-circle"></i> Create New Exam</h5>
            </div>
            <div class="card-body">
              <?php if (!empty($data['errors'])): ?>
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    <?php foreach ($data['errors'] as $field => $error): ?>
                      <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <form method="POST" action="" class="needs-validation">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="exam_title" class="form-label">Exam Title *</label>
                    <input type="text" id="exam_title" name="exam_title" class="form-control" value="<?= isset($_POST['exam_title']) ? htmlspecialchars($_POST['exam_title']) : ''; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="course_id" class="form-label">Course *</label>
                    <select id="course_id" name="course_id" class="form-select" required>
                      <option value="">-- Select Course --</option>
                      <?php if (!empty($data['courses'])): ?>
                        <?php foreach ($data['courses'] as $course): ?>
                          <option value="<?= $course->id ?>" <?= ($data['row']->course_id ?? null) == $course->id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($course->title) ?>
                          </option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="exam_datetime" class="form-label">Date & Time *</label>
                    <input type="datetime-local" id="exam_datetime" name="exam_datetime" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label for="exam_duration" class="form-label">Duration (minutes) *</label>
                    <input type="number" id="exam_duration" name="exam_duration" class="form-control" value="60" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-4">
                    <label for="total_question" class="form-label">Total Questions *</label>
                    <input type="number" id="total_question" name="total_question" class="form-control" value="0" required>
                  </div>
                  <div class="col-md-4">
                    <label for="right_answer_mark" class="form-label">Right Answer Mark *</label>
                    <input type="number" id="right_answer_mark" name="right_answer_mark" step="0.01" class="form-control" value="1" required>
                  </div>
                  <div class="col-md-4">
                    <label for="wrong_answer_mark" class="form-label">Wrong Answer Mark *</label>
                    <input type="number" id="wrong_answer_mark" name="wrong_answer_mark" step="0.01" class="form-control" value="0" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="exam_description" class="form-label">Description</label>
                  <textarea id="exam_description" name="exam_description" class="form-control" rows="4"></textarea>
                </div>

                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Create Exam</button>
                  <a href="<?=ROOT?>/admin/exams" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
              </form>
            </div>
          </div>

        <!-- Edit/View Action -->
        <?php elseif ($data['action'] == 'edit' || $data['action'] == 'view'): ?>
          <div class="card">
            <div class="card-header">
              <h5><?= ucfirst($data['action']) ?> Exam</h5>
            </div>
            <div class="card-body">
              <?php if (!empty($data['errors'])): ?>
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    <?php foreach ($data['errors'] as $field => $error): ?>
                      <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <?php if (!empty($data['row'])): ?>
                <form method="POST" action="" class="needs-validation">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="exam_title" class="form-label">Exam Title</label>
                      <input type="text" id="exam_title" name="exam_title" class="form-control" 
                        value="<?= htmlspecialchars($data['row']->exam_title ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6">
                      <label for="course_id" class="form-label">Course</label>
                      <select id="course_id" name="course_id" class="form-select" required>
                        <option value="">-- Select Course --</option>
                        <?php if (!empty($data['courses'])): ?>
                          <?php foreach ($data['courses'] as $course): ?>
                            <option value="<?= $course->id ?>" 
                              <?= ($data['row']->course_id ?? null) == $course->id ? 'selected' : '' ?>>
                              <?= htmlspecialchars($course->title) ?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="exam_datetime" class="form-label">Exam Date & Time</label>
                      <input type="datetime-local" id="exam_datetime" name="exam_datetime" class="form-control" 
                        value="<?= $data['row']->exam_datetime ?? ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                      <label for="exam_duration" class="form-label">Duration (minutes)</label>
                      <input type="number" id="exam_duration" name="exam_duration" class="form-control" 
                        value="<?= $data['row']->exam_duration ?? '60'; ?>" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="total_question" class="form-label">Total Questions</label>
                      <input type="number" id="total_question" name="total_question" class="form-control" 
                        value="<?= $data['row']->total_question ?? '0' ?>" required>
                    </div>
                    <div class="col-md-4">
                      <label for="right_answer_mark" class="form-label">Right Answer Mark</label>
                      <input type="number" id="right_answer_mark" name="right_answer_mark" step="0.01" class="form-control" 
                        value="<?= $data['row']->right_answer_mark ?? '1' ?>" required>
                    </div>
                    <div class="col-md-4">
                      <label for="wrong_answer_mark" class="form-label">Wrong Answer Mark</label>
                      <input type="number" id="wrong_answer_mark" name="wrong_answer_mark" step="0.01" class="form-control" 
                        value="<?= $data['row']->wrong_answer_mark ?? '0' ?>" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="exam_description" class="form-label">Description</label>
                    <textarea id="exam_description" name="exam_description" class="form-control" rows="4">
                      <?= $data['row']->exam_description ?? '' ?>
                    </textarea>
                  </div>

                  <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Save</button>
                    <a href="<?=ROOT?>/admin/exams" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                  </div>
                </form>
              <?php else: ?>
                <div class="alert alert-danger">
                  <i class="bi bi-emoji-frown"></i> Exam not found.
                </div>
                <a href="<?=ROOT?>/admin/exams" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
              <?php endif; ?>
            </div>
          </div>

        <!-- Delete Action -->
        <?php elseif ($data['action'] == 'delete'): ?>
          <div class="card">
            <div class="card-header bg-danger text-white">
              <h5 class="mb-0"><i class="bi bi-trash"></i> Delete Exam</h5>
            </div>
            <div class="card-body">
              <?php if (!empty($data['row'])): ?>
                <p class="text-danger fs-5"><i class="bi bi-exclamation-triangle"></i> Are you sure you want to delete this exam?</p>
                <p><strong>Title:</strong> <?=htmlspecialchars($data['row']->exam_title)?></p>
                <p><strong>Created:</strong> <?=$data['row']->exam_created_on?></p>
                
                <form method="POST" action="">
                  <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                    <a href="<?=ROOT?>/admin/exams" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancel</a>
                  </div>
                </form>
              <?php else: ?>
                <div class="alert alert-danger">
                  <i class="bi bi-emoji-frown"></i> Exam not found.
                </div>
                <a href="<?=ROOT?>/admin/exams" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
              <?php endif; ?>
            </div>
          </div>

        <!-- Main List View -->
        <?php else: ?>
          <!-- Teacher's Exams Card -->
          <?php if (!empty($data['teacher_exams'])): ?>
            <div class="card mb-4">
              <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square"></i> My Exams</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="table-light">
                      <tr>
                        <th>Exam Title</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                        <th>Duration</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data['teacher_exams'] as $exam): ?>
                        <tr>
                          <td><?=htmlspecialchars($exam->exam_title)?></td>
                          <td>
                            <?php if ($exam->approved == 1 && $exam->published == 1): ?>
                              <span class="badge bg-success">Published</span>
                            <?php elseif ($exam->approved == 0): ?>
                              <span class="badge bg-warning">Pending Approval</span>
                            <?php else: ?>
                              <span class="badge bg-secondary">Draft</span>
                            <?php endif; ?>
                          </td>
                          <td><?=$exam->exam_datetime?></td>
                          <td><?=$exam->exam_duration?> min</td>
                          <td>
                            <a href="<?=ROOT?>/admin/exams/view/<?=$exam->id?>" class="btn btn-sm btn-outline-primary">
                              <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?=ROOT?>/admin/exams/edit/<?=$exam->id?>" class="btn btn-sm btn-outline-secondary">
                              <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?=ROOT?>/admin/exams/delete/<?=$exam->id?>" class="btn btn-sm btn-outline-danger">
                              <i class="bi bi-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Enrollment Requests Card -->
            <div class="card mb-4">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-people"></i> Student Enrollment Requests</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="select-exam" class="form-label">Select Exam to Review Requests:</label>
                  <select id="select-exam" class="form-select">
                    <option value="">-- Choose an exam --</option>
                    <?php foreach ($data['teacher_exams'] as $exam): ?>
                      <option value="<?= $exam->id ?>" <?= ($data['row']->exam_id ?? null) == $exam->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($exam->exam_title) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div id="requests-panel" class="table-responsive" style="display: none;">
                  <table class="table table-striped">
                    <thead class="table-light">
                      <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="requests-tbody">
                      <tr><td colspan="4" class="text-center text-muted">Loading...</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <!-- Exam Management Card -->
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">
                <i class="bi bi-card-checklist"></i> Exams Management
                <?php if ($uid->role_id == 3 || $uid->role_id == 2): ?>
                  <a href="<?=ROOT?>/admin/exams/add" class="btn btn-outline-primary btn-sm float-end">
                    <i class="bi bi-plus-circle"></i> New Exam
                  </a>
                <?php endif; ?>
              </h5>
            </div>
            <div class="card-body">
              <?php if ($uid->role_id == 3): ?>
                <div class="alert alert-info">
                  <i class="bi bi-info-circle"></i> Admin can publish exams from the "Pending Exam Approvals" section above.
                </div>
              <?php else: ?>
                <div class="alert alert-danger">
                  <i class="bi bi-info-circle"></i> No Exams to show.
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Select exam for viewing requests
  const selectExamEl = document.getElementById('select-exam');
  if (selectExamEl) {
    selectExamEl.addEventListener('change', function() {
      if (this.value) {
        loadExamRequests(this.value);
      } else {
        document.getElementById('requests-panel').style.display = 'none';
      }
    });
  }

  function loadExamRequests(examId) {
    safeFetch('<?=ROOT?>/admin/exams', {
      exam_id: examId,
      ajax: 'load_exam_requests'
    }).then(data => {
      if (data.success) {
        document.getElementById('requests-tbody').innerHTML = data.html;
        document.getElementById('requests-panel').style.display = 'block';
        bindRequestForms();
      }
    }).catch(err => console.error('Error:', err));
  }

  function bindRequestForms() {
    document.querySelectorAll('.request-form').forEach(form => {
      form.querySelector('select').addEventListener('change', function() {
        const status = this.value;
        const examId = form.dataset.examId;
        const userId = form.dataset.userId;
        
        if (status) {
          updateRequestStatus(examId, userId, status);
        }
      });
    });
  }

  function updateRequestStatus(examId, userId, status) {
    safeFetch('<?=ROOT?>/admin/exams', {
      exam_id: examId,
      user_id: userId,
      status: status,
      ajax: 'update_request_status'
    }).then(data => {
      if (data.success) {
        alert(data.message);
        loadExamRequests(examId);
      }
    }).catch(err => console.error('Error:', err));
  }

  // Publish exam (Admin)
  document.querySelectorAll('.publish-exam').forEach(btn => {
    btn.addEventListener('click', function() {
      const examId = this.dataset.examId;
      if (confirm('Publish this exam? Students will be able to enroll.')) {
        safeFetch('<?=ROOT?>/admin/exams', {
          exam_id: examId,
          ajax: 'publish_exam'
        }).then(data => {
          if (data.success) {
            alert(data.message);
            location.reload();
          }
        }).catch(err => console.error('Error:', err));
      }
    });
  });

  function safeFetch(url, data) {
    const formData = new URLSearchParams(data);
    return fetch(url, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    }).then(response => response.json());
  }
});
</script>

<?php $this->view('partials/private.footer',$data) ?>
