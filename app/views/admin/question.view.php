<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav', $data) ?>

<?php if (!defined("ROOT")) die ("Direct Script acess Denied"); ?>

  <main id="main" class="main">
    <?php if ($uid->role_id != 1): ?>
      <?php if ($action == 'add'): ?>
        <div class="pagetitle">
          <h1 class=""><?=$data['title']?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><?=$data['title']?></li>
              <li class="breadcrumb-item active"><?=$data['action']?></li>
            </ol>
          </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="row mb-5">

              <!-- Customers Card -->
              <div class="col-xxl-12 row">

                <!-- ---------- New-Question ---------- -->
                <div class="card col-md-6 mx-auto">
                  <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-card-checklist fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;<?=ucfirst($data['title'])?></h5>

                    <!-- Form with No Lables -->
                    <form class="row g-3 py-2" method="post" enctype="multipart/form-data">

                      <div class="col-md-6">
                        <label for="question_type" class="ms-2">Question Type&colon;</label>
                        <select name="question_type" id="question_type" class="form-select" onchange="toggleQuestionFields(this.value)">
                          <option value="multiple_choice" <?=($_POST['question_type'] ?? 'multiple_choice') == 'multiple_choice' ? 'selected' : ''?>>Multiple Choice (4 options)</option>
                          <option value="true_false" <?=($_POST['question_type'] ?? '') == 'true_false' ? 'selected' : ''?>>True / False / Not given</option>
                          <option value="yes_no" <?=($_POST['question_type'] ?? '') == 'yes_no' ? 'selected' : ''?>>Yes / No / Not given</option>
                          <option value="audio_completion" <?=($_POST['question_type'] ?? '') == 'audio_completion' ? 'selected' : ''?>>Uploaded Audio + Sentence Completion</option>
                          <option value="map_picture" <?=($_POST['question_type'] ?? '') == 'map_picture' ? 'selected' : ''?>>Map / Picture</option>
                          <option value="diagram" <?=($_POST['question_type'] ?? '') == 'diagram' ? 'selected' : ''?>>Diagram</option>
                          <option value="short_answer" <?=($_POST['question_type'] ?? '') == 'short_answer' ? 'selected' : ''?>>Short Answer</option>
                          <option value="matching" <?=($_POST['question_type'] ?? '') == 'matching' ? 'selected' : ''?>>Matching / Headings / Info / Sentence ending</option>
                          <option value="summary_completion" <?=($_POST['question_type'] ?? '') == 'summary_completion' ? 'selected' : ''?>>Summary Completion</option>
                          <option value="writing_prompt" <?=($_POST['question_type'] ?? '') == 'writing_prompt' ? 'selected' : ''?>>Writing Task / Prompt</option>
                          <option value="speaking_prompt" <?=($_POST['question_type'] ?? '') == 'speaking_prompt' ? 'selected' : ''?>>Speaking Task / Prompt</option>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label for="question_title" class="ms-2">Question Title&colon;</label><br>
                        <input type="text" name="question_title" id="question_title" value="<?=htmlspecialchars($_POST['question_title'] ?? '')?>" class="form-control <?=!empty($errors['question_title']) ? 'border-danger' : '';?>" placeholder="Question Title" autofocus>
                        <?php if(!empty($errors['question_title'])):?>
                          <small class="text-danger"><?=$errors['question_title']?>.</small>
                        <?php endif;?>
                      </div>

                      <div class="col-md-6">
                        <label for="exam_id" class="ms-2">Exam&colon;</label><br>
                        <input type="text" id="exam_id" class="form-control" value="<?=esc($target_exam->exam_title ?? 'Exam not found')?>" disabled>
                        <?php if(!empty($errors['exam_id'])):?>
                          <small class="text-danger"><?=$errors['exam_id']?>.</small>
                        <?php endif;?>
                      </div>

                      <div id="answer-option-block" class="col-md-6">
                        <label for="answer_option" class="ms-2">Correct Answer&colon;</label>
                        <select name="answer_option" id="answer_option" class="form-select <?=!empty($errors['answer_option']) ? 'border-danger' : '';?>>">
                          <option value="">Select the correct option...</option>
                          <?php for ($option_number = 1; $option_number <= 4; $option_number++): ?>
                            <option value="<?=$option_number?>" <?=($_POST['answer_option'] ?? '') == (string)$option_number ? 'selected' : ''?>>Option <?=$option_number?></option>
                          <?php endfor; ?>
                        </select>
                        <?php if (!empty($errors['answer_option'])): ?>
                          <small class="text-danger"><?=$errors['answer_option']?></small>
                        <?php endif; ?>
                      </div>

                      <div id="answer-text-block" class="col-md-12">
                        <label for="answer_text" class="ms-2">Expected Answer / Marking Key&colon;</label>
                        <textarea name="answer_text" id="answer_text" rows="4" class="form-control <?=!empty($errors['answer_text']) ? 'border-danger' : '';?>" placeholder="Add the expected answer, model answer, or key points here"><?=htmlspecialchars($_POST['answer_text'] ?? '')?></textarea>
                        <?php if (!empty($errors['answer_text'])): ?>
                          <small class="text-danger"><?=$errors['answer_text']?></small>
                        <?php endif; ?>
                      </div>

                      <div id="audio-file-block" class="col-md-12">
                        <label for="audio_file" class="ms-2">Audio upload (Listening) &colon;</label>
                        <input type="file" name="audio_file" id="audio_file" class="form-control" accept=".mp3,.wav,.m4a,.ogg,.aac,audio/mpeg,audio/wav,audio/mp4,audio/ogg">
                        <small class="text-muted">Allowed: MP3, WAV, M4A, OGG, AAC. Max 15MB.</small>
                        <textarea name="audio_caption" id="audio_caption" rows="2" class="form-control mt-2" placeholder="Optional audio caption or transcript title"><?=htmlspecialchars($_POST['audio_caption'] ?? '')?></textarea>
                      </div>

                      <div id="image-file-block" class="col-md-12">
                        <label for="image_file" class="ms-2">Map / picture upload &colon;</label>
                        <input type="file" name="image_file" id="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        <small class="text-muted">Allowed: JPG, PNG, WEBP. Max 8MB.</small>
                        <textarea name="image_caption" id="image_caption" rows="2" class="form-control mt-2" placeholder="Optional image caption or map label"><?=htmlspecialchars($_POST['image_caption'] ?? '')?></textarea>
                      </div>

                      <div id="diagram-file-block" class="col-md-12">
                        <label for="diagram_file" class="ms-2">Diagram upload &colon;</label>
                        <input type="file" name="diagram_file" id="diagram_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,.svg,image/jpeg,image/png,image/webp,image/svg+xml">
                        <small class="text-muted">Allowed: JPG, PNG, WEBP, SVG. Max 8MB.</small>
                        <textarea name="diagram_caption" id="diagram_caption" rows="2" class="form-control mt-2" placeholder="Optional diagram caption"><?=htmlspecialchars($_POST['diagram_caption'] ?? '')?></textarea>
                      </div>

                      <div id="task-prompt-block" class="col-md-12">
                        <label for="task_prompt" class="ms-2">Task prompt / question brief&colon;</label>
                        <textarea name="task_prompt" id="task_prompt" rows="4" class="form-control <?=!empty($errors['task_prompt']) ? 'border-danger' : '';?>" placeholder="Describe the task or prompt, such as a writing question, speaking cue card, or academic diagram question."><?=htmlspecialchars($_POST['task_prompt'] ?? '')?></textarea>
                        <?php if (!empty($errors['task_prompt'])): ?>
                          <small class="text-danger"><?=$errors['task_prompt']?></small>
                        <?php endif; ?>
                      </div>

                      <div id="rubric-text-block" class="col-md-12">
                        <label for="rubric_text" class="ms-2">Rubric / marking guide&colon;</label>
                        <textarea name="rubric_text" id="rubric_text" rows="4" class="form-control <?=!empty($errors['rubric_text']) ? 'border-danger' : '';?>" placeholder="Explain assessment criteria: coherence, lexical resource, grammatical range, task achievement, etc."><?=htmlspecialchars($_POST['rubric_text'] ?? '')?></textarea>
                        <?php if (!empty($errors['rubric_text'])): ?>
                          <small class="text-danger"><?=$errors['rubric_text']?></small>
                        <?php endif; ?>
                        <div class="row mt-2">
                          <div class="col-md-6">
                            <label for="rubric_type" class="ms-2">Rubric type&colon;</label>
                            <select name="rubric_type" id="rubric_type" class="form-select">
                              <option value="writing" <?=($_POST['rubric_type'] ?? '') == 'writing' ? 'selected' : ''?>>Writing</option>
                              <option value="speaking" <?=($_POST['rubric_type'] ?? '') == 'speaking' ? 'selected' : ''?>>Speaking</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="band_score" class="ms-2">Band score&colon;</label>
                            <input type="number" name="band_score" id="band_score" min="0" max="9" value="<?=htmlspecialchars($_POST['band_score'] ?? '0')?>" class="form-control">
                          </div>
                        </div>
                        <textarea name="rubric_notes" id="rubric_notes" rows="2" class="form-control mt-2" placeholder="Optional rubric notes or examiner guidance"><?=htmlspecialchars($_POST['rubric_notes'] ?? '')?></textarea>
                      </div>

                      <div id="options-block" class="col-md-12 row g-3">
                        <?php for ($option_number = 1; $option_number <= 4; $option_number++): ?>
                          <div class="col-md-6">
                            <label for="option_number_<?=$option_number?>" class="ms-2">Option <?=$option_number?>&colon;</label>
                            <input type="text" name="option_number_<?=$option_number?>" id="option_number_<?=$option_number?>" class="form-control <?=!empty($errors['option_number_'.$option_number]) ? 'border-danger' : '';?>" value="<?=htmlspecialchars($_POST['option_number_'.$option_number] ?? '')?>" >
                            <?php if (!empty($errors['option_number_'.$option_number])): ?>
                              <small class="text-danger"><?=$errors['option_number_'.$option_number]?></small>
                            <?php endif; ?>
                          </div>
                        <?php endfor; ?>
                      </div>

                      <div class="col-md-12">
                        <label for="extra_notes" class="ms-2">Additional guidance or rubric notes&colon;</label>
                        <textarea name="extra_notes" id="extra_notes" rows="3" class="form-control" placeholder="Optional instructions for markers or teachers"><?=htmlspecialchars($_POST['extra_notes'] ?? '')?></textarea>
                      </div>

                      <!-- ---- Hidden Inputs ---- -->
                      <input type="hidden" name="exam_id" value="<?=$target_id?>">
                      <!-- -| ./Hidden Inputs\. |- -->

                      <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary" name="add_question" value="save"><i class="bx bx-save"></i> Save</button>
                        <a href="<?=ROOT?>/admin/question/<?=$target_id?>">
                          <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                    </form>

                    <script>
                      function toggleQuestionFields(type) {
                        const optionsBlock = document.getElementById('options-block');
                        const answerOptionBlock = document.getElementById('answer-option-block');
                        const answerTextBlock = document.getElementById('answer-text-block');
                        const optionInputs = document.querySelectorAll('[id^="option_number_"]');
                        const answerSelect = document.getElementById('answer_option');

                        const multipleChoiceTypes = ['multiple_choice', 'true_false', 'yes_no'];
                        const answerKeyTypes = ['short_answer', 'sentence_completion', 'summary_completion', 'matching', 'map_picture', 'diagram', 'audio_completion', 'writing_prompt', 'speaking_prompt'];
                        const writingPromptTypes = ['writing_prompt', 'speaking_prompt'];
                        const assetTypes = ['audio_completion', 'map_picture', 'diagram'];

                        const isMultipleChoice = multipleChoiceTypes.includes(type);
                        answerSelect.required = isMultipleChoice;
                        answerSelect.disabled = !isMultipleChoice;

                        optionInputs.forEach((input) => {
                          input.required = isMultipleChoice;
                          input.disabled = !isMultipleChoice;
                        });

                        if (isMultipleChoice) {
                          optionsBlock.style.display = 'flex';
                          answerOptionBlock.style.display = 'block';
                          if (type === 'true_false' || type === 'yes_no') {
                            answerSelect.innerHTML = '<option value="">Select the correct option...</option>' +
                              '<option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option>';
                          } else {
                            answerSelect.innerHTML = '<option value="">Select the correct option...</option>' +
                              '<option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option><option value="4">Option 4</option>';
                          }
                          optionInputs.forEach((input, index) => {
                            input.closest('.col-md-6').style.display = index < 4 ? 'block' : 'none';
                          });
                        } else {
                          optionsBlock.style.display = 'none';
                          answerOptionBlock.style.display = 'none';
                          optionInputs.forEach((input) => {
                            input.value = '';
                            input.closest('.col-md-6').style.display = 'none';
                          });
                          answerSelect.value = '';
                        }

                        if (answerKeyTypes.includes(type)) {
                          answerTextBlock.style.display = 'block';
                        } else {
                          answerTextBlock.style.display = 'none';
                        }

                        if (writingPromptTypes.includes(type)) {
                          document.getElementById('task-prompt-block').style.display = 'block';
                          document.getElementById('rubric-text-block').style.display = 'block';
                        } else {
                          document.getElementById('task-prompt-block').style.display = 'none';
                          document.getElementById('rubric-text-block').style.display = 'none';
                        }

                        if (assetTypes.includes(type)) {
                          document.getElementById('audio-file-block').style.display = type === 'audio_completion' ? 'block' : 'none';
                          document.getElementById('image-file-block').style.display = type === 'map_picture' ? 'block' : 'none';
                          document.getElementById('diagram-file-block').style.display = type === 'diagram' ? 'block' : 'none';
                        } else {
                          document.getElementById('audio-file-block').style.display = 'none';
                          document.getElementById('image-file-block').style.display = 'none';
                          document.getElementById('diagram-file-block').style.display = 'none';
                        }
                      }

                      document.addEventListener('DOMContentLoaded', function() {
                        const initialType = document.getElementById('question_type').value;
                        toggleQuestionFields(initialType);
                      });
                    </script>
                    <!-- End Form with No Lables -->
                  </div>
                  <!-- -| ./Card-Body\. |- -->
                </div>
                <!-- -------| ./New-Question\. |------- -->
              </div>
              <!-- End Customers Card -->
            </div>
            <!-- End Left side columns -->
          </div>
        </section>

      <?php elseif ($action == 'delete'): ?>
        <div class="pagetitle">
          <h1><?=$data['title']?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><?=$data['title']?></li>
              <li class="breadcrumb-item active"><?=$data['action']?></li>
              <li class="breadcrumb-item"><?=$target_question?></li>
            </ol>
          </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="row">

              <!-- Customers Card -->
              <div class="col-xxl-12">

                <!-- -----| Delete Course Tabs |----- -->
                <div class="card col-md-8 mx-auto">
                  <div class="card-body">
                    <h5 class="card-title text-danger"><i class="bi bi-trash fs-5"></i> Are you sure you want to&nbsp;<?=$data['action']?>&nbsp;this record&quest;</h5>

                    <form class="row g-3 py-2" method="get">

                      <?php if (!empty($rows)) :?>
                        <?php foreach ($rows as $key => $row) :?>
                          <div class="col-md-12">
                            <label for="question_title" class="ms-2">Qustion Title&colon;</label><br>
                            <input type="text" name="question_title" id="question_title" value="<?=esc($row->question_title)?>" class="form-control" disabled>
                          </div>

                          <div class="col-md-12">
                            <label for="exam_id" class="ms-2">Exam&colon;</label><br>
                            <input type="text" name="exam_title" id="exam_title" value="<?=esc($row->exam_row->exam_title)?>" class="form-control" disabled>
                            </select>
                          </div>

                          <!-- ---- Hidden Inputs ---- -->
                          <input type="hidden" name="exam_id" value="<?=$target_id?>">
                          <!-- -| ./Hidden Inputs\. |- -->

                          <div class="text-center">
                            <button type="submit" class="btn btn-outline-danger" name="delete_question"><i class="bi bi-trash"></i> Delete</button>
                            <a href="<?=ROOT?>/admin/question/<?=$target_id?>">
                              <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                            </a>
                          </div>
                        <?php endforeach;?>
                      <?php else:?>
                        <div class="text-center">
                          <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                            <a href="<?=ROOT?>/admin/question/<?=$target_id?>">
                            <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                          </a>
                        </div>
                      <?php endif;?>
                    </form>

                  </div>
                </div>
                <!-- ---| ./Delete Course Tabs\. |--- -->

              </div>
              <!-- End Customers Card -->
            </div>
            <!-- End Left side columns -->
          </div>
        </section>

      <?php elseif ($action == 'edit'): ?>
        <div class="card col-md-6 mx-auto">
          <div class="card-body" id="js-myform">

            <!-- ---- Save Buttons ---- -->
            <div class="mt-3 float-end">
              <button onclick="save_content()" name="edit_question" value="edit" class="js-save-button btn btn-secondary disabled"><i class="ri-save-3-fill"></i> Save</button>
              <a href="<?=ROOT?>/admin/question/<?=$rows->exam_id?>">
                <button class="btn btn-outline-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
              </a>
            </div>
            <!-- -| ./Save Buttons\. |- -->

            <h5 class="card-title"><i class="bi bi-card-checklist fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;<?=ucfirst($data['title'])?></h5>

            <!-- ---- Progress-Bar ---- -->
            <div class="progress my-4 js-save-progress hide">
              <div class="progress-bar progress-bar-video js-save-progress-inner" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <!-- -| ./Progress-Bar\. |- -->

            <!-- Form with No Lables -->
            <form class="row g-3 mt-3 py-2" method="post">

              <div class="col-md-12">
                <label for="exam_id">Question ID&colon;&nbsp;</label>
                <span class="fw-bolder"><?=esc($target_id)?></span>
              </div>

              <div class="col-md-6">
                <label for="question_title" class="ms-2">Qustion Title&colon;</label><br>
                <input type="text" name="question_title" id="question_title" value="<?=$rows->question_title ?? ''?>" oninput="something_changed(event)" class="form-control <?=!empty($errors['question_title']) ? 'border-danger' : '';?>" disabled placeholder="Question Title">
                <!-- ---- EXAM Title Error ---- -->
                <?php if(!empty($errors['question_title'])):?>
                  <small class="text-danger"><?=$errors['question_title']?>.</small>
                <?php endif;?>
                <!-- -| ./EXAM Title Error\. |- -->
              </div>

              <div class="col-md-6">
                <label for="right_answer" class="ms-2">Exam&colon;</label><br>
                <select name="exam_id" id="exam_id" onchange="something_changed(event)" class="form-select <?=!empty($errors['exam_id']) ? 'border-danger' : '';?>" disabled>
                  <option value="" disabled>Select an exam...</option>
                  <?php if (!empty($exam_rows)) : ?>
                    <?php foreach ($exam_rows as $row): ?>
                      <option <?=set_select('id',$rows->exam_id,$row->id)?> value="<?=$row->id?>"><?=$row->exam_title?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <!-- ---- Exam_ID Error ---- -->
                <?php if(!empty($errors['exam_id'])):?>
                  <small class="text-danger"><?=$errors['exam_id']?>.</small>
                <?php endif;?>
                <!-- -| ./Exam_ID Error\. |- -->
              </div>

              <?php if (!empty($question_options)) : ?>
                <?php foreach ($question_options as $key => $value) : ?>
                  <div class="col-md-6">
                    <label for="option_number_<?=$value->option_number?>" class="ms-2">Option <?=$value->option_number?>&colon;</label><br>
                    <input type="text" name="option_number_<?=$value->option_number?>" id="option_number_<?=$value->option_number?>" oninput="something_changed(event)" value="<?=esc($value->option_title ?? '')?>" class="form-control <?=!empty($errors['option_'.$value->option_number]) ? 'border-danger' : '';?>" placeholder="First Option">
                    <!-- ---- EXAM Title Error ---- -->
                    <?php if(!empty($errors['option_'.$value->option_number])):?>
                      <small class="text-danger"><?=$errors['option_'.$value->option_number]?>.</small>
                    <?php endif;?>
                    <!-- -| ./EXAM Title Error\. |- -->
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-md-6">
                  <label for="option_number_1" class="ms-2">Option 1&colon;</label><br>
                  <input type="text" name="option_number_1" id="option_number_1" value="" oninput="something_changed(event)" class="form-control <?=!empty($errors['option_1']) ? 'border-danger' : '';?>" placeholder="First Option">
                  <!-- ---- EXAM Title Error ---- -->
                  <?php if(!empty($errors['option_1'])):?>
                    <small class="text-danger"><?=$errors['option_1']?>.</small>
                  <?php endif;?>
                  <!-- -| ./EXAM Title Error\. |- -->
                </div>

                <div class="col-md-6">
                  <label for="option_number_2" class="ms-2">Option 2&colon;</label><br>
                  <input type="text" name="option_number_2" id="option_number_2" value="" oninput="something_changed(event)" class="form-control <?=!empty($errors['option_2']) ? 'border-danger' : '';?>" placeholder="Second Option">
                  <!-- ---- EXAM Title Error ---- -->
                  <?php if(!empty($errors['option_2'])):?>
                    <small class="text-danger"><?=$errors['option_2']?>.</small>
                  <?php endif;?>
                  <!-- -| ./EXAM Title Error\. |- -->
                </div>

                <div class="col-md-6">
                  <label for="option_number_3" class="ms-2">Option 3&colon;</label><br>
                  <input type="text" name="option_number_3" id="option_number_3" value="" oninput="something_changed(event)" class="form-control <?=!empty($errors['option_3']) ? 'border-danger' : '';?>" placeholder="Third Option">
                  <!-- ---- EXAM Title Error ---- -->
                  <?php if(!empty($errors['option_3'])):?>
                    <small class="text-danger"><?=$errors['option_3']?>.</small>
                  <?php endif;?>
                  <!-- -| ./EXAM Title Error\. |- -->
                </div>

                <div class="col-md-6">
                  <label for="option_number_4" class="ms-2">Option 4&colon;</label><br>
                  <input type="text" name="option_number_4" id="option_number_4" value="" oninput="something_changed(event)" class="form-control <?=!empty($errors['option_4']) ? 'border-danger' : '';?>" placeholder="Fourth Option">
                  <!-- ---- EXAM Title Error ---- -->
                  <?php if(!empty($errors['option_4'])):?>
                    <small class="text-danger"><?=$errors['option_4']?>.</small>
                  <?php endif;?>
                  <!-- -| ./EXAM Title Error\. |- -->
                </div>
              <?php endif; ?>

              <div class="col-md-12">
                <label for="answer_option" class="ms-2">Rigth Answer</label><br>
                <select name="answer_option" id="answer_option" onchange="something_changed(event)" class="form-select <?=!empty($errors['answer_option']) ? 'border-danger' : '';?>">
                  <option value="" disabled>Select an option...</option>
                  <option <?=set_select('answer_option',$rows->answer_option,1)?> value="1">Option 1</option>
                  <option <?=set_select('answer_option',$rows->answer_option,2)?> value="2">Option 2</option>
                  <option <?=set_select('answer_option',$rows->answer_option,3)?> value="3">Option 3</option>
                  <option <?=set_select('answer_option',$rows->answer_option,4)?> value="4">Option 4</option>
                </select>
                <!-- ---- COURSE_ID Error ---- -->
                <?php if(!empty($errors['answer_option'])):?>
                  <small class="text-danger"><?=$errors['answer_option']?>.</small>
                <?php endif;?>
                <!-- -| ./COURSE_ID Error\. |- -->
              </div>

              <!-- ---- Hidden Inputs ---- -->
              <input type="hidden" name="question_id" value="<?=$target_id?>">
              <input type="hidden" name="exam_id" value="<?=$rows->exam_id?>">
              <!-- -| ./Hidden Inputs\. |- -->

              <!-- <div class="text-center">
                <button type="submit" class="btn btn-outline-success" name="edit_question" value="save"><i class="bx bx-save"></i> Save</button>
                <a href="<?=ROOT?>/admin/question/<?=$rows->exam_id?>">
                  <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                </a>
              </div> -->
            </form>
            <!-- End Form with No Lables -->
          </div>
          <!-- -| ./Card-Body\. |- -->
        </div>
      <?php elseif ($action == 'view'): ?>
        <div class="card col-md-6 mx-auto">
          <div class="card-body" id="js-myform">

            <!-- ---- Back Button ---- -->
            <div class="mt-3 float-end">
              <a href="<?=ROOT?>/admin/question/<?=$rows->exam_id?>">
                <button class="btn btn-outline-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
              </a>
            </div>
            <!-- -| ./Back Button\. |- -->

            <h5 class="card-title"><i class="bi bi-card-checklist fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;<?=ucfirst($data['title'])?></h5>

            <!-- Form with No Lables -->
            <div class="row g-3 mt-3 py-2">

              <div class="col-md-12">
                <span for="exam_id">Question ID&colon;&nbsp;</span>
                <span class="fw-bolder"><?=esc($target_id)?></span>
              </div>

              <div class="my-3 col-md-6">
                <span class="">Qustion Title&colon;</span><br>
                <span class="form-control">
                  <?=esc($rows->question_title)?>
                </span>
              </div>

              <div class="my-3 col-md-6">
                <span class="">Exam Title&colon;</span><br>
                <span class="form-control">
                  <?=esc($rows->exam_row->exam_title)?>
                </span>
              </div>

              <?php foreach ($question_options as $key => $value) : ?>
                <div class="my-3 col-md-6">
                  <span class="ms-2">Option <?=$value->option_number?>&colon;</span><br>
                  <?php if ($value->option_number == $value->question_row->answer_option): ?>
                    <span class="form-control border-danger">
                  <?php else: ?>
                    <span class="form-control">
                  <?php endif; ?>
                    <?=esc($value->option_title ?? '')?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
            <!-- End Form with No Lables -->
          </div>
          <!-- -| ./Card-Body\. |- -->
        </div>
      <?php else: ?>
        <div class="pagetitle row">
          <div class="col-md-6">
            <h1 class=""><?=$data['title']?></h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><?=$data['title']?></li>
                <li class="breadcrumb-item"><?=$data['target_id']?></li>
              </ol>
            </nav>
          </div>
          <div class="col-md-6 w-50">
            <!-- ---- CHECK Page MESSAGES ---- -->
            <!-- <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
              <?php if(message()):?>
                <span class="alert alert-warning">
                  <i class="bi bi-envelope-dash"></i>
                    <span class=""><?=message('',true)?></span>
                </span>
              <?php else:?>
                <span class="alert alert-warning">
                  <i class="bi bi-envelope-dash"></i>
                    <span id="message_operation"></span>
                </span>
              <?php endif;?>
            </div> -->
            <!-- -| ./CHECK Page MESSAGES\. |- -->
          </div>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <!-- <div class="col-lg-8"> -->
              <div class="row">

                <!-- Customers Card -->
                <div class="col-xxl-12">
                <!-- <?=show($rows)?> -->

                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <?php if(!empty($rows)):?>
                          <i class="bi bi-card-checklist fs-5"></i> Totla&nbsp;<?=$data['title']?>&colon;
                          <?php if(count($rows) != $rows[0]->exam_row->total_question):?>
                            <a href="<?=ROOT?>/admin/question/add/<?=$target_id?>" class="fontAlido">
                              <button class="btn btn-outline-primary float-end"><i class="bi bi-question-octagon"></i> New Question</button>
                            </a>
                            <?=count($rows)?>/<?=($rows[0]->exam_row->total_question) ?: '22'?>
                          <?php else: ?>
                            <?=count($rows)?>/<?=$rows[0]->exam_row->total_question?>
                          <?php endif; # ---|./IF(Total Question) ?>
                        <?php else: ?>
                          <a href="<?=ROOT?>/admin/question/add/<?=$target_id?>" class="fontAlido">
                            <button class="btn btn-outline-primary float-end"><i class="bi bi-question-octagon"></i> New Question</button>
                          </a>
                        <?php endif; # ---|./IF(ROWS) ?>
                        <a href="<?=ROOT?>/admin/exams" class="btn btn-outline-secondary float-end me-3"><i class="bi bi-box-arrow-left"></i> Back</a>
                      </h5>

                      <!-- Table with stripped rows -->
                      <table class="table table-striped" id="js-exam-table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Exam</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">View</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <?php if(!empty($rows)):?>
                          <tbody>
                            <?php foreach($rows as $row):?>
                              <tr>
                                <th scope="row"><?=$row->id?></th>
                                <td><?=esc($row->exam_row->exam_title)?></td>
                                <td><?=esc($row->question_title)?></td>
                                <td><?=esc($row->answer_option)?></td>
                                <td class="">
                                  <a href="<?=ROOT?>/admin/question/view/<?=$row->id?>" class="btn btn-sm btn-warning fontAlido">
                                    View
                                  </a>
                                </td>
                                <td class="">
                                  <a href="<?=ROOT?>/admin/question/edit/<?=$row->id?>">
                                    <i class="bx bx-pencil fs-5 text-success"></i> 
                                  </a>
                                  <a href="<?=ROOT?>/admin/question/delete/<?=$row->id?>">
                                    <i class="bx bx-trash fs-5 text-danger"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        <?php else:?>
                          <tbody>
                            <tr>
                              <td class="text-center text-danger" colspan="10">
                                <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
                                <a href="<?=ROOT?>/admin/exams">
                                  <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        <?php endif;?>
                      </table>
                    <!-- End Table with stripped rows -->

                    </div>
                  </div>
                </div>
                <!-- End Customers Card -->
              </div>
            <!-- </div> -->
            <!-- End Left side columns -->
          </div>
        </section>
      <?php endif; ?>
    <?php else: ?>
      <div class="alert alert-danger fontAlido">
        <h2 class="h4">Nothing to show</h2>
      </div>
    <?php endif; ?>

    <script>
      // Variables  ---------------
      var dirty = false;
      var data = {};
      // ------------|  ./Variables

      function send_data(obj) {
        const myform = new FormData();
        for (key in obj){
          myform.append(key,obj[key]);
        }
        // ---| ./FOR()

        const ajax = new XMLHttpRequest();

        /**
        * ----------------
        * | Progress Bar |
        * ----------------
        */
        document.querySelector(".js-save-progress-inner").style.width = 0 + "%";
        document.querySelector(".js-save-progress-inner").innerHTML = 0 + "%";
        document.querySelector(".js-save-progress").classList.remove("hide");
        ajax.upload.addEventListener('progress',function(e){
          // ...| Calculate Pregress Precentage
          let percent = Math.round((e.loaded / e.total) * 100);
          document.querySelector(".js-save-progress-inner").style.width = percent + "%";
          document.querySelector(".js-save-progress-inner").innerHTML = percent + "%";
        });
        // ---| ./Progress Bar

        ajax.addEventListener('readystatechange',function(){
          if (ajax.readyState == 4){
            // ...| TRUE Block
            if (ajax.status == 200){
              // ...| TRUE Block | Success!
              // alert("Upload Complete!");
              document.querySelector(".js-save-progress").classList.add("hide");
              disable_save_button(false);
              handle_result(ajax.responseText);
              // window.location.reload();
            } else {
              //  ...| FALSE Block | Error!
              alert("Oh, no! Error Occurred.");
            }
            // ---| ./IF/ELSE(AJAX.Status)
          }
          // ---| ./IF(AJAX.ReadyState)
        });
        
        ajax.open('post','',true);
        ajax.send(myform);
      }
      // ---| ./Send_Data()

      function handle_result(result) {
        // console.log(result);
        if (result.substr(0,2) == '{"') {
          // ...| TRUE Block
          var obj = JSON.parse(result);
          if (typeof obj == 'object') {
            // ...| TRUE Block
            if (obj.data_type == "save") {
              // ...| SAVE Block
              alert("Update complete!");
              disable_save_button(false);
              dirty = false;
              // window.location.reload();
              window.location.href = "../"+obj.data_url;
            }
            // ---|./IF(Data_type)
          } else {
            alert("ElSe");
          }
          // ---| ./IF(OBJECT)
        }
        // ---| ./IF(SubString)
      }
      // ---| ./Handle_Result()

      function something_changed(e) {
        disable_save_button(true);
      }
      // ---| ./Something_Changed()

      function disable_save_button(status = false) {
        if (status) {
          // ...| TRUE Block
          document.querySelector(".js-save-button").classList.remove("disabled");
          document.querySelector(".js-save-button").classList.remove("btn-secondary");
          document.querySelector(".js-save-button").classList.add("btn-outline-success");
        } else {
          // ...| FALSE Block
          document.querySelector(".js-save-button").classList.add("disabled");
          document.querySelector(".js-save-button").classList.add("btn-secondary");
        }
        // ---| ./IF/ELSE(Status)
      }
      // ---| ./Disable_Save_Button()

      /**
      * --------------------------
      * | Saving Button Contents |
      * --------------------------
      */
      function save_content() {
        var content = document.querySelector("#js-myform");
        var inputs = content.querySelectorAll("input,select,button");

        var obj = {};
        obj.data_type = "save";

        for (var i = 0; i < inputs.length; i++) {
          var key = inputs[i].name;
          obj[key] = inputs[i].value;
        }
        // ---| ./FOR(Inputs)

        send_data(obj);
      }
      // ---| ./Save_Content()
    </script>

    <!-- ======= Footer ======= -->
  </main>

<?php $this->view('partials/private.footer',$data) ?>
