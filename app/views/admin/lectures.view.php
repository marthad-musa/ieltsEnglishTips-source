<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<main class="main" id="main">
  <div class="pagetitle">
    <h1>Course Lectures</h1>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title">Course Lectures</h5>
          <a href="<?=ROOT?>/admin/lectures/add" class="btn btn-sm btn-primary">Add Lecture</a>
        </div>

        <?php if ($action == 'add'): ?>
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Section</label>
              <select name="unid" class="form-select <?=!empty($errors['lecture']) ? 'border-danger' : '';?>">
                <option value="" selected disabled>Select section</option>
                <?php if (!empty($sections)): ?>
                  <?php foreach ($sections as $section): ?>
                    <option value="<?=esc($section->unid)?>"><?=esc($section->course_title)?> (Section ID <?=esc($section->unid)?>)</option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Lecture title</label>
              <input type="text" name="title" value="<?=set_value('title')?>" class="form-control <?=!empty($errors['lecture']) ? 'border-danger' : '';?>" placeholder="Lecture title">
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3" placeholder="Lecture description"><?=set_value('description')?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Video / File</label>
              <input type="file" name="file" class="form-control">
            </div>
            <?php if (!empty($errors['lecture'])): ?>
              <div class="alert alert-danger"><?=esc($errors['lecture'])?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success">Create Lecture</button>
            <a href="<?=ROOT?>/admin/lectures" class="btn btn-secondary ms-2">Cancel</a>
          </form>
        <?php else: ?>
          <?php if (!empty($rows)): ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Course ID</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row): ?>
                  <tr>
                    <td><?=esc($row->id)?></td>
                    <td><?=esc($row->title)?></td>
                    <td><?=esc($row->description)?></td>
                    <td><?=esc($row->course_id ?? 'N/A')?></td>
                    <td>
                      <form method="post" action="<?=ROOT?>/admin/lectures/delete/<?=$row->id?>" onsubmit="return confirm('Delete this lecture?')">
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <div class="alert alert-warning">No lectures available.</div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php $this->view('partials/private.footer',$data) ?>