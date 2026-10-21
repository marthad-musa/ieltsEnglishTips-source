<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>

<main class="main">
  <section class="section py-5">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
          <span class="badge bg-primary-subtle text-primary mb-2">Student exam</span>
          <h1 class="h2 mb-1"><?= htmlspecialchars($exam->exam_title ?? 'Exam') ?></h1>
          <?php if (!empty($exam->exam_description)): ?>
            <p class="text-muted mb-0"><?= nl2br(htmlspecialchars($exam->exam_description)) ?></p>
          <?php endif; ?>
        </div>
        <div class="text-md-end small text-muted">
          <?php if (!empty($exam->exam_duration)): ?>
            <div><strong>Duration:</strong> <?= htmlspecialchars($exam->exam_duration) ?></div>
          <?php endif; ?>
          <?php if (!empty($questions)): ?>
            <div><strong>Questions:</strong> <?= count($questions) ?></div>
          <?php endif; ?>
        </div>
      </div>

      <?php if (empty($questions)): ?>
        <div class="alert alert-info">
          No questions have been added to this exam yet.
        </div>
      <?php else: ?>
        <form method="post" action="<?= rtrim(ROOT, '/') . '/exam/take/' . ($exam->id ?? 0) ?>">
          <?php foreach ($questions as $index => $question): ?>
            <?php
              $payload = $question_model->decode_question_data($question);
              $question_type = $question_model->normalize_question_type($payload['question_type'] ?? ($question->question_type ?? 'multiple_choice'));
            ?>
            <div class="card shadow-sm border-0 mb-4">
              <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
                  <h4 class="h5 mb-0">Question <?= (int)($index + 1) ?></h4>
                  <span class="badge text-bg-light border">
                    <?= htmlspecialchars(str_replace('_', ' ', ucfirst($question_type))) ?>
                  </span>
                </div>

                <?php echo $question_model->render_question_html($question); ?>

                <?php if (in_array($question_type, ['multiple_choice', 'true_false', 'yes_no'], true)): ?>
                  <?php $options = []; ?>
                  <?php if (is_array($payload['options'] ?? null)): ?>
                    <?php $options = $payload['options']; ?>
                  <?php endif; ?>
                  <?php if (empty($options)): ?>
                    <?php $optionRows = (new \Database())->query('select * from question_option where question_id = :question_id order by option_number asc', ['question_id' => (int)($question->id ?? 0)]); ?>
                    <?php if (is_array($optionRows)) : ?>
                      <?php foreach ($optionRows as $optionRow): ?>
                        <?php $options[(int)($optionRow['option_number'] ?? 0)] = $optionRow['option_title'] ?? ''; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if (!empty($options)): ?>
                    <div class="mt-3">
                      <?php foreach ($options as $optionNumber => $optionText): ?>
                        <?php $optionLabel = htmlspecialchars((string)$optionText, ENT_QUOTES, 'UTF-8'); ?>
                        <label class="d-flex align-items-center gap-2 border rounded p-2 mb-2">
                          <input type="radio" name="answer[<?= (int)($question->id ?? 0) ?>]" value="<?= (int)$optionNumber ?>">
                          <span><?= $optionLabel ?></span>
                        </label>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                <?php elseif (in_array($question_type, ['short_answer', 'sentence_completion', 'summary_completion', 'matching', 'diagram', 'audio_completion', 'map_picture', 'writing_prompt', 'speaking_prompt'], true)): ?>
                  <div class="mt-3">
                    <?php if ($question_type === 'writing_prompt' || $question_type === 'speaking_prompt'): ?>
                      <textarea name="answer[<?= (int)($question->id ?? 0) ?>]" class="form-control" rows="8" placeholder="Write your response here..."></textarea>
                    <?php else: ?>
                      <textarea name="answer[<?= (int)($question->id ?? 0) ?>]" class="form-control" rows="4" placeholder="Type your answer here..."></textarea>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Submit answers</button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php $this->view('partials/public.footer', $data) ?>
