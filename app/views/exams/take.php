<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card card-body bg-light mt-5">
            <h2><?php echo $data['exam']->title; ?></h2>
            <hr>
            <form action="<?php echo URLROOT; ?>/exams/submit/<?php echo $data['exam']->id; ?>" method="post">
              <?php foreach($data['questions'] as $index => $question) : ?>
                <div class="question-box mb-4">
                  <h5><?php echo ($index + 1) . '. ' . $question->question_text; ?></h5>
                  <?php foreach($question->options as $option) : ?>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="question_<?php echo $question->id; ?>" id="option_<?php echo $option->id; ?>" value="<?php echo $option->id; ?>">
                      <label class="form-check-label" for="option_<?php echo $option->id; ?>">
                        <?php echo $option->option_text; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endforeach; ?>
              <input type="submit" value="Submit Exam" class="btn btn-success">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
