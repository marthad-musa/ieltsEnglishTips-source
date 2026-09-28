<?php $this->view('partials/private.header', $data) ?>
<?php $this->view('partials/private.nav', $data) ?>
<?php
  $questions_json = json_encode($questions, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
  $answers_json = json_encode($saved_answers, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
?>
<main class="main" id="main">
  <div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
      <h1><?=esc($exam->exam_title)?></h1>
      <nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="<?=ROOT?>/admin/exams">Exams</a></li><li class="breadcrumb-item active">Take Exam</li></ol></nav>
    </div>
    <?php if ($state === 'active'): ?><div class="badge bg-dark fs-6" id="exam-timer" role="timer" aria-live="polite"></div><?php endif; ?>
  </div>

  <section class="section">
    <?php if ($state === 'waiting'): ?>
      <div class="alert alert-info" role="status">
        <h2 class="h5">Your exam has not started yet</h2>
        <p class="mb-0">The exam opens at <?=esc($exam->exam_datetime)?>. This page will update automatically when it is available.</p>
      </div>
    <?php elseif ($state === 'invalid'): ?>
      <div class="alert alert-danger" role="alert">This exam schedule is incomplete. Please contact an administrator.</div>
    <?php elseif ($state === 'active' && $questions): ?>
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="mb-0 text-muted" id="question-position"></p>
            <span class="badge bg-secondary">Choose one answer</span>
          </div>
          <div id="question-content" aria-live="polite"></div>
          <div id="answer-save-status" class="small text-muted mt-3" aria-live="polite"></div>
          <div class="d-flex justify-content-between gap-2 mt-4">
            <button type="button" class="btn btn-outline-secondary" id="previous-question">Previous</button>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-outline-secondary" id="next-question">Next</button>
              <button type="button" class="btn btn-primary" id="submit-exam">Submit Exam</button>
            </div>
          </div>
        </div>
      </div>
    <?php elseif ($state === 'active'): ?>
      <div class="alert alert-warning">This exam has no questions available. Please contact an administrator.</div>
    <?php endif; ?>
  </section>
</main>

<?php if ($state === 'active' && $questions): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const questions = <?=$questions_json ?: '[]'?>;
  const savedAnswers = <?=$answers_json ?: '{}'?>;
  const examId = <?= (int)$exam->id ?>;
  const deadline = <?= (int)$deadline ?>;
  const serverNow = <?= (int)$server_now ?>;
  const renderedAt = Date.now();
  const csrfCode = <?=json_encode((string)$csrf_code)?>;
  const content = document.getElementById('question-content');
  const position = document.getElementById('question-position');
  const saveStatus = document.getElementById('answer-save-status');
  let current = 0;
  let saveQueue = Promise.resolve();
  let saveFailed = false;
  let submitting = false;

  function renderQuestion() {
    const question = questions[current];
    position.textContent = 'Question ' + (current + 1) + ' of ' + questions.length;
    content.replaceChildren();
    const title = document.createElement('h2');
    title.className = 'h5 mb-4';
    title.textContent = question.title;
    content.appendChild(title);
    const group = document.createElement('div');
    group.className = 'list-group';
    question.options.forEach(function(option) {
      const label = document.createElement('label');
      label.className = 'list-group-item d-flex gap-3 align-items-start';
      const input = document.createElement('input');
      input.type = 'radio';
      input.name = 'answer';
      input.value = option.id;
      input.className = 'form-check-input flex-shrink-0 mt-1';
      input.checked = Number(savedAnswers[question.id]) === Number(option.id);
      input.addEventListener('change', function() { saveAnswer(question.id, option.id); });
      const text = document.createElement('span');
      text.textContent = option.title;
      label.append(input, text);
      group.appendChild(label);
    });
    content.appendChild(group);
    document.getElementById('previous-question').disabled = current === 0;
    document.getElementById('next-question').disabled = current === questions.length - 1;
  }

  function saveAnswer(questionId, optionId) {
    savedAnswers[questionId] = optionId;
    saveStatus.textContent = 'Saving answer...';
    saveQueue = saveQueue.then(function() {
      const body = new URLSearchParams({exam_id: examId, question_id: questionId, option_id: optionId, csrf_code: csrfCode});
      return fetch('<?=ROOT?>/exam/save-answer', {method: 'POST', body: body, headers: {'X-Requested-With': 'XMLHttpRequest'}})
        .then(response => response.json())
        .then(data => {
          if (!data.success) throw new Error(data.message || 'Answer could not be saved.');
          saveFailed = false;
          saveStatus.textContent = 'Answer saved';
        });
    }).catch(function(error) {
      saveFailed = true;
      saveStatus.textContent = error.message;
    });
  }

  function submitExam(timedOut = false) {
    if (submitting) return;
    submitting = true;
    document.getElementById('submit-exam').disabled = true;
    function sendSubmission() {
      const body = new URLSearchParams({csrf_code: csrfCode});
      return fetch('<?=ROOT?>/exam/submit/' + examId, {method: 'POST', body: body, headers: {'X-Requested-With': 'XMLHttpRequest'}});
    }
    const submission = timedOut
      ? sendSubmission()
      : saveQueue.then(function() {
          if (saveFailed) throw new Error('An answer could not be saved. Retry it before submitting.');
          return sendSubmission();
        });
    submission.then(response => response.json()).then(function(data) {
      if (data.success && data.redirect) {
        window.location.href = data.redirect;
        return;
      }
      throw new Error(data.message || 'Exam submission failed.');
    }).catch(function(error) {
      submitting = false;
      document.getElementById('submit-exam').disabled = false;
      saveStatus.textContent = error.message;
    });
  }

  document.getElementById('previous-question').addEventListener('click', function() { if (current > 0) { current--; renderQuestion(); } });
  document.getElementById('next-question').addEventListener('click', function() { if (current < questions.length - 1) { current++; renderQuestion(); } });
  document.getElementById('submit-exam').addEventListener('click', function() {
    if (window.confirm('Submit this exam now? You will not be able to change your answers afterward.')) submitExam();
  });

  function updateTimer() {
    const elapsed = Math.floor((Date.now() - renderedAt) / 1000);
    const remaining = Math.max(0, deadline - serverNow - elapsed);
    const minutes = Math.floor(remaining / 60);
    const seconds = remaining % 60;
    document.getElementById('exam-timer').textContent = minutes + ':' + String(seconds).padStart(2, '0');
    if (remaining <= 0) submitExam(true);
  }

  renderQuestion();
  updateTimer();
  window.setInterval(updateTimer, 1000);
});
</script>
<?php elseif ($state === 'waiting'): ?>
<script>window.setTimeout(function() { window.location.reload(); }, 5000);</script>
<?php endif; ?>

<?php $this->view('partials/private.footer', $data) ?>
