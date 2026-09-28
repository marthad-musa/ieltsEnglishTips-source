<?php $this->view('partials/private.header', $data) ?>
<?php $this->view('partials/private.nav', $data) ?>
<main class="main" id="main">
  <div class="pagetitle">
    <h1><?=esc($title)?></h1>
    <nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="<?=ROOT?>/admin/exams">Exams</a></li><li class="breadcrumb-item active"><?=esc($title)?></li></ol></nav>
  </div>
  <section class="section">
    <?php if (empty($results)): ?>
      <div class="alert alert-info">No final scores are available yet.</div>
    <?php else: ?>
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table align-middle">
            <thead><tr>
              <th>Exam</th>
              <?php if ($role_id !== 1): ?><th>Student</th><?php endif; ?>
              <th>Correct</th><th>Wrong</th><th>Unanswered</th><th>Score</th><th>Percent</th><th>Status</th><th>Submitted</th>
              <?php if ($role_id === 3): ?><th>Review</th><?php endif; ?>
            </tr></thead>
            <tbody>
              <?php foreach ($results as $result): ?>
                <tr>
                  <td><?=esc($result->exam_title ?? $result->exam->exam_title ?? 'Exam')?></td>
                  <?php if ($role_id !== 1): ?><td><?=esc(trim(($result->firstname ?? '').' '.($result->lastname ?? '')))?></td><?php endif; ?>
                  <td><?= (int)$result->correct_count ?></td>
                  <td><?= (int)$result->wrong_count ?></td>
                  <td><?= (int)$result->unanswered_count ?></td>
                  <td><?=number_format((float)$result->score, 2)?></td>
                  <td><?=number_format((float)$result->percentage, 2)?>%</td>
                  <td>
                    <span class="badge bg-<?=($result->status === 'Approved' ? 'success' : 'secondary')?>"><?=esc($result->status)?></span>
                    <?php if (($result->notes ?? '') === 'Timed out'): ?><span class="badge bg-warning text-dark">Timed out</span><?php endif; ?>
                    <?php if ((int)($result->retake_allowed ?? 0) === 1): ?><span class="badge bg-info text-dark">Retake allowed</span><?php endif; ?>
                  </td>
                  <td><?=esc($result->submitted_at ?? '')?></td>
                  <?php if ($role_id === 3): ?>
                    <td>
                      <?php if ($result->status === 'Submitted'): ?>
                        <button type="button" class="btn btn-sm btn-outline-success review-result" data-result-id="<?= (int)$result->id ?>" data-exam-id="<?= (int)$result->exam_id ?>" data-retake="0">Approve</button>
                        <button type="button" class="btn btn-sm btn-outline-primary review-result" data-result-id="<?= (int)$result->id ?>" data-exam-id="<?= (int)$result->exam_id ?>" data-retake="1">Approve + retake</button>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </section>
</main>
<?php if ($role_id === 3): ?>
<script>
document.querySelectorAll('.review-result').forEach(function(button) {
  button.addEventListener('click', function() {
    const payload = new URLSearchParams({
      ajax: 'approve_exam_result',
      result_id: button.dataset.resultId,
      exam_id: button.dataset.examId,
      allow_retake: button.dataset.retake,
      csrf_code: <?=json_encode((string)($_SESSION['csrf_code'] ?? ''))?>
    });
    fetch('<?=ROOT?>/admin/exams', {method: 'POST', body: payload, headers: {'X-Requested-With': 'XMLHttpRequest'}})
      .then(response => response.json())
      .then(data => {
        if (!data.success) throw new Error(data.message || 'Could not approve result.');
        window.location.reload();
      })
      .catch(error => window.alert(error.message));
  });
});
</script>
<?php endif; ?>
<?php $this->view('partials/private.footer', $data) ?>
