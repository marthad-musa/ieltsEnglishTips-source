<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<main class="main">
  <div class="pagetitle">
    <h1>Quizzes</h1>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title">Quizzes</h5>
          <a href="<?=ROOT?>/admin/exams/add" class="btn btn-sm btn-primary">New Quiz</a>
        </div>

        <?php if (!empty($rows)): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Course</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row): ?>
                <tr>
                  <td><?=esc($row->id)?></td>
                  <td><?=esc($row->exam_title)?></td>
                  <td><?=esc($row->course_id)?></td>
                  <td><?=esc($row->exam_status ?? 'Created')?></td>
                  <td>
                    <a href="<?=ROOT?>/admin/exams/edit/<?=$row->id?>" class="btn btn-sm btn-secondary">Edit</a>
                    <form method="post" action="<?=ROOT?>/admin/quizzes/delete/<?=$row->id?>" style="display:inline-block" onsubmit="return confirm('Delete this quiz?')">
                      <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-warning">No quizzes found.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
