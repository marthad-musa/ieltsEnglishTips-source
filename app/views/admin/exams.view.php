<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

  <main class="main" id="main">
    <?php if ($action == 'add'): ?>
      <div class="pagetitle">
        <h1 class="fontClarity"><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><?=$data['title']?></li>
            <li class="breadcrumb-item active"><?=$data['action']?></li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="row mb-5">

            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-12 row">

              <!-- ---------- New-Test ---------- -->
              <div class="card col-md-5 mx-auto">
                <div class="card-body">
                  <h5 class="card-title fontClarity"><i class="bi bi-card-checklist fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;Exam</h5>

                  <!-- Form with No Lables -->
                  <form class="row g-3 py-2" method="post">

                    <div class="col-md-12">
                      <input type="text" name="exam_title" value="<?=set_value('exam_title')?>" class="form-control <?=!empty($errors['exam_title']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Title">
                      <!-- ---- EXAM Title Error ---- -->
                      <?php if(!empty($errors['exam_title'])):?>
                        <small class="text-danger fontClarity"><?=$errors['exam_title']?>.</small>
                      <?php endif;?>
                      <!-- -| ./EXAM Title Error\. |- -->
                    </div>
                    <div class="col-md-12">
                      <select name="course_id" id="course_id" class="form-select <?=!empty($errors['course_id']) ? 'border-danger' : '';?> fontClarity">
                        <option value="" selected="" disabled>Course...</option>
                        <?php if(!empty($courses)): ?>
                          <?php foreach($courses as $course): ?>
                            <option <?=set_select('course_id',$course->id)?> value="<?=$course->id?>"><?=esc($course->title)?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <!-- ---- COURSE_ID Error ---- -->
                      <?php if(!empty($errors['course_id'])):?>
                        <small class="text-danger fontClarity"><?=$errors['course_id']?>.</small>
                      <?php endif;?>
                      <!-- -| ./COURSE_ID Error\. |- -->
                    </div>
                    <?php csrf() ?>
                    <div class="text-center fontClarity">
                      <button type="submit" class="btn btn-outline-primary"><i class="bx bx-save"></i> Save</button>
                      <a href="<?=ROOT?>/admin/exams">
                        <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  </form>
                  <!-- End Form with No Lables -->
                </div>
                <!-- -| ./Card-Body\. |- -->
              </div>
              <!-- -------| ./New-Test\. |------- -->
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
            <li class="breadcrumb-item"><?=$data['row']->id?></li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="row">

            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-12">

              <!-- -----| Delete Course Tabs |----- -->
              <div class="card col-md-8 mx-auto">
                <div class="card-body">
                  <?php if (!empty($row)) :?>
                    <h5 class="card-title text-danger"><i class="bi bi-trash fs-5"></i> Are you sure you want to&nbsp;<?=$data['action']?>&nbsp;this record&quest;</h5>
                    <form method="POST">
                      <div class="mt-3 float-end fontClarity">
                        <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                        <a href="<?=ROOT?>/admin/courses">
                          <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                      <p class="">Exam Title&colon;&nbsp;<span class="text-primary fs-5"><?=esc($row->exam_title)?></span></p>
                      <p class="">Course&colon;&nbsp;<?=esc($row->course_row->title)?></p>
                      <p class="">Date created&colon;&nbsp;<?=get_date($row->exam_created_on)?></p>
                    </form>
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
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
      <div class="pagetitle">
        <h1><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><?=$data['title']?></li>
            <li class="breadcrumb-item active"><?=$data['action']?></li>
            <li class="breadcrumb-item"><?=$data['row']->id?></li>
          </ol>
        </nav>
        <div class="col-md-6 w-50">
          <!-- ---- CHECK Page MESSAGES ---- -->
          <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
            <?php if(message()):?>
              <span class="alert alert-warning">
                <i class="bi bi-envelope-dash"></i>
                  <span class=""><?=message('',true)?></span>
              </span>
            <?php endif;?>
          </div>
          <!-- -| ./CHECK Page MESSAGES\. |- -->
        </div>
      </div>
      <!-- End Page Title -->
      <!-- <?=show($data)?> -->
      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="row">

            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-8 mx-auto">

              <!-- -----| Edit Course Tabs |----- -->
              <div class="card">
                <div class="card-body row">
                  <?php if (!empty($row)) :?>

                    <h5 class="card-title text-success"><i class="bx bx-pencil fs-5"></i>&nbsp;<?=esc($row->exam_title)?></h5>
                    <div class="col-md-6">
                      <span class="badge rounded-pill bg-secondary my-1"><i class="bi bi-clock me-1"></i> Exam created on&colon;&nbsp;</span>
                      <code class="d-block ms-4"><?=get_date($row->exam_created_on)?></code>
                    </div>
                    
                    <!-- ---- EXAM CSRF Code ---- -->
                    <div class="col-md-6">
                      <span class="badge rounded-pill bg-secondary my-1"><i class="bi bi-question-circle me-1"></i> Exam code&colon;&nbsp;</span>
                      <code class="d-block ms-4"><?=esc($row->csrf_code)?></code>
                      <input type="hidden" name="csrf_code" value="<?=esc($row->csrf_code)?>" class="form-control <?=!empty($errors['csrf_code']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Code" readonly>
                      <?php if(!empty($errors['csrf_code'])):?>
                        <small class="text-danger fontClarity"><?=$errors['csrf_code']?>.</small>
                      <?php endif;?>
                    </div>
                    <!-- -| ./EXAM CSRF Code\. |- -->

                    <!-- ---- Progress-Bar ---- -->
                    <div class="progress my-2 js-save-progress hide">
                      <div class="progress-bar progress-bar-video js-save-progress-inner" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <!-- -| ./Progress-Bar\. |- -->
                    
                    <!-- Floating Labels Form -->
                    <div class="col-12 py-4">
                      <form method="POST" id="exam_form" class="row g-3 js-myForm">
                        
                        <div class="col-md-6">
                          <label for="exam_title" class="ms-2 fontClarity">Exam Title</label>
                          <input type="text" name="exam_title" id="exam_title" value="<?=esc($row->exam_title)?>" class="form-control <?=!empty($errors['exam_title']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Title">
                          <!-- ---- EXAM Title Error ---- -->
                          <?php if(!empty($errors['exam_title'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_title']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Title Error\. |- -->
                        </div>
                        <div class="col-md-6">
                          <label for="course_id" class="ms-2 fontClarity">Course ID</label>
                          <select name="course_id" id="course_id" class="form-select <?=!empty($errors['course_id']) ? 'border-danger' : '';?> fontClarity">
                            <option value="" selected="" disabled>Course...</option>
                            <?php if(!empty($courses)): ?>
                              <?php foreach($courses as $course): ?>
                                <option <?=set_select('course_id',$course->id,($row->course_id ?? 1))?> value="<?=$course->id?>"><?=esc($course->title)?></option>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <option value="Nothing to show">Nothing</option>
                            <?php endif; ?>
                          </select>
                          <!-- ---- COURSE_ID Error ---- -->
                          <?php if(!empty($errors['course_id'])):?>
                            <small class="text-danger fontClarity"><?=$errors['course_id']?>.</small>
                          <?php endif;?>
                          <!-- -| ./COURSE_ID Error\. |- -->
                        </div>

                        <!-- ---------| Exam Time & Duration |--------- -->
                        <div class="col-md-6">
                          <!-- ---- EXAM Time ---- -->
                          <label for="exam_datetime" class="ms-2 fontClarity">Exam Date &amp; Time</label>
                          <input type="datetime-local" name="exam_datetime" id="exam_datetime" value="<?=$row->exam_datetime ?? ''?>" class="form-control <?=!empty($errors['exam_datetime']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Date &amp; Time" rreadonly>
                          <?php if(!empty($errors['exam_datetiem'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_datetiem']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Time\. |- -->
                        </div>
                        <div class="col-md-6">
                          <!-- ---- EXAM Duration ---- -->
                          <label for="exam_duration" class="ms-2 fontClarity">Exam Duration</label>
                          <select name="exam_duration" id="exam_duration" class="form-select <?=!empty($errors['exam_duration']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Exam duration...</option>
                            <option name="exam_duration" value="5" <?=set_select('exam_duration',($row->exam_duration),5)?>>5 Minutes</option>
                            <option name="exam_duration" value="30" <?=set_select('exam_duration',($row->exam_duration),30)?>>30 Minutes</option>
                            <option name="exam_duration" value="60" <?=set_select('exam_duration',($row->exam_duration),60)?>>1 Hour</option>
                            <option name="exam_duration" value="90" <?=set_select('exam_duration',($row->exam_duration),90)?>>1 Hour &amp; 30 Minutes</option>
                            <option name="exam_duration" value="120" <?=set_select('exam_duration',($row->exam_duration),120)?>>2 Hours</option>
                            <option name="exam_duration" value="150" <?=set_select('exam_duration',($row->exam_duration),150)?>>2 Hours &amp; 30 Minutes</option>
                          </select>
                          <?php if(!empty($errors['exam_duration'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_duration']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Duration\. |- -->
                        </div>
                        <!-- -------| ./Exam Time & Duration\. |------- -->
                        
                        <!-- ---------| Exam Questions |--------- -->
                        <div class="col-md-4">
                          <label for="total_question" class="ms-2 fontClarity">Total Question</label>
                          <select name="total_question" id="total_question" class="form-select <?=!empty($errors['total_question']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Total question...</option>
                            <option name="total_question" value="5" <?=set_select('total_question',($row->total_question),5)?>>5 Questions</option>
                            <option name="total_question" value="10" <?=set_select('total_question',($row->total_question),10)?>>10 Questions</option>
                            <option name="total_question" value="15" <?=set_select('total_question',($row->total_question),15)?>>15 Questions</option>
                            <option name="total_question" value="20" <?=set_select('total_question',($row->total_question),20)?>>20 Questions</option>
                            <option name="total_question" value="25" <?=set_select('total_question',($row->total_question),25)?>>25 Questions</option>
                            <option name="total_question" value="30" <?=set_select('total_question',($row->total_question),30)?>>30 Questions</option>
                          </select>
                          <?php if(!empty($errors['total_question'])):?>
                            <small class="text-danger fontClarity"><?=$errors['total_question']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Total Questions\. |- -->
                        </div>
                        <div class="col-md-4">
                          <label for="right_answer_mark" class="ms-2 fontClarity">Right Answer Mark</label>
                          <select name="right_answer_mark" id="right_answer_mark" class="form-select <?=!empty($errors['right_answer_mark']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Right answer mark...</option>
                            <option name="right_answer_mark" value="1" <?=set_select('right_answer_mark',($row->right_answer_mark),'1')?>>+1 Mark</option>
                            <option name="right_answer_mark" value="2" <?=set_select('right_answer_mark',($row->right_answer_mark),'2')?>>+2 Mark</option>
                            <option name="right_answer_mark" value="3" <?=set_select('right_answer_mark',($row->right_answer_mark),'3')?>>+3 Mark</option>
                            <option name="right_answer_mark" value="4" <?=set_select('right_answer_mark',($row->right_answer_mark),'4')?>>+4 Mark</option>
                            <option name="right_answer_mark" value="5" <?=set_select('right_answer_mark',($row->right_answer_mark),'5')?>>+5 Mark</option>
                          </select>
                          <?php if(!empty($errors['right_answer_mark'])):?>
                            <small class="text-danger fontClarity"><?=$errors['right_answer_mark']?>.</small>
                          <?php endif;?>
                          <!-- -| ./RIGHT Answer Mark\. |- -->
                        </div>
                        <div class="col-md-4">
                          <label for="wrong_answer_mark" class="ms-2 fontClarity">Wrong Answer Mark</label>
                          <select name="wrong_answer_mark" id="wrong_answer_mark" class="form-select <?=!empty($errors['wrong_answer_mark']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Wrong answer mark...</option>
                            <option name="wrong_answer_mark" value="1" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1')?>>-1 Mark</option>
                            <option name="wrong_answer_mark" value="1.25" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1.25')?>>-1.25 Mark</option>
                            <option name="wrong_answer_mark" value="1.50" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1.50')?>>-1.50 Mark</option>
                            <option name="wrong_answer_mark" value="2" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'2')?>>-2 Mark</option>
                          </select>
                          <?php if(!empty($errors['wrong_answer_mark'])):?>
                            <small class="text-danger fontClarity"><?=$errors['wrong_answer_mark']?>.</small>
                          <?php endif;?>
                          <!-- -| ./WRONG Answer Mark\. |- -->
                        </div>
                        <!-- -------| ./Exam Questions\. |------- -->

                        <!-- ---------| Exam Status |--------- -->
                        <div class="col-md-6">
                          <label for="exam_status" class="ms-2 fontClarity">Exam Status</label>
                          <select name="exam_status" id="exam_status" class="form-select <?=!empty($errors['exam_status']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Choose a status...</option>
                            <option name="exam_status" value="Pending" <?=set_select('exam_status','Pending',($row->exam_status))?>>Pending</option>
                            <option name="exam_status" value="Created" <?=set_select('exam_status','Created',($row->exam_status))?>>Created</option>
                            <option name="exam_status" value="Started" <?=set_select('exam_status','Started',($row->exam_status))?>>Started</option>
                            <option name="exam_status" value="Completed" <?=set_select('exam_status','Completed',($row->exam_status))?>>Completed</option>
                          </select>
                          <?php if(!empty($errors['exam_status'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_status']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Status\. |- -->
                        </div>

                        <!-- ---------| QUESTIONS |--------- -->
                        <!-- <?=$question_button?> -->
                        <!-- <div class="col-md-6">
                          <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label><br>
                          <a href="<?=ROOT?>/admin/question/<?=$row->id?>/add" class="btn btn-sm btn-outline-info add_question" id="<?=$row->id?>">
                            <i class="bi bi-question-circle"></i> Add Question
                          </a>
                          <a href="<?=ROOT?>/admin/question/<?=$row->csrf_code?>" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-question-circle"></i> View Exam
                          </a>
                        </div> -->
                        <!-- -------| ./QUESTIONS\. |------- -->

                        <!-- ---------| Hidden Inputs |--------- -->
                        <input type="hidden" name="id" id="id" value="<?=$row->id?>">
                        <!-- <input type="hidden" name="page" value="edit_exam">
                        <input type="hidden" name="action" value="Edit"> -->
                        <!-- -------| ./Hidden Inputs\. |------- -->
                        
                        <!-- ---------| Buttons |--------- -->
                        <div class="col-md-12 text-center fontClarity">
                          <!-- <input type="submit" name="editExam" id="editExam" value="Save" class="btn btn-outline-success"> -->
                          <button type="submit" name="editExam" id="editExam" value="Save" class="btn btn-outline-success"><i class="bx bx-save"></i> Save</button>
                          <a href="<?=ROOT?>/admin/exams">
                            <button class="btn btn-outline-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                          </a>
                        </div>
                        <!-- -------| ./Buttons\. |------- -->
                      </form>  
                    </div>
                    <!-- End floating Labels Form -->

                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                </div>
              </div>
              <!-- ---| ./Edit Course Tabs\. |--- -->

            </div>
            <!-- End Customers Card -->
          </div>
          <!-- End Left side columns -->
        </div>
      </section>

    <?php elseif ($action == 'view'): ?>
      <div class="pagetitle">
        <h1><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><?=$data['title']?></li>
            <li class="breadcrumb-item active"><?=$data['action']?></li>
            <li class="breadcrumb-item"><?=$data['row']->id?></li>
          </ol>
        </nav>
        <div class="col-md-6 w-50">
          <!-- ---- CHECK Page MESSAGES ---- -->
          <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
            <?php if(message()):?>
              <span class="alert alert-warning">
                <i class="bi bi-envelope-dash"></i>
                  <span class=""><?=message('',true)?></span>
              </span>
            <?php endif;?>
          </div>
          <!-- -| ./CHECK Page MESSAGES\. |- -->
        </div>
      </div>
      <!-- End Page Title -->
      <!-- <?=show($data)?> -->
      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="row">

            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-8 mx-auto">

              <!-- -----| Edit Course Tabs |----- -->
              <div class="card">
                <div class="card-body row">
                  <?php if (!empty($row)) :?>

                    <h5 class="card-title text-success"><i class="bx bx-pencil fs-5"></i>&nbsp;<?=esc($row->exam_title)?></h5>
                    <div class="col-md-6">
                      <span class="badge rounded-pill bg-secondary my-1"><i class="bi bi-clock me-1"></i> Exam created on&colon;&nbsp;</span>
                      <code class="d-block ms-4"><?=get_date($row->exam_created_on)?></code>
                    </div>
                    
                    <!-- ---- EXAM CSRF Code ---- -->
                    <div class="col-md-6">
                      <span class="badge rounded-pill bg-secondary my-1"><i class="bi bi-question-circle me-1"></i> Exam code&colon;&nbsp;</span>
                      <code class="d-block ms-4"><?=esc($row->csrf_code)?></code>
                      <input type="hidden" name="csrf_code" value="<?=esc($row->csrf_code)?>" class="form-control <?=!empty($errors['csrf_code']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Code" readonly>
                      <?php if(!empty($errors['csrf_code'])):?>
                        <small class="text-danger fontClarity"><?=$errors['csrf_code']?>.</small>
                      <?php endif;?>
                    </div>
                    <!-- -| ./EXAM CSRF Code\. |- -->

                    <!-- ---- Progress-Bar ---- -->
                    <div class="progress my-2 js-save-progress hide">
                      <div class="progress-bar progress-bar-video js-save-progress-inner" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <!-- -| ./Progress-Bar\. |- -->
                    
                    <!-- Floating Labels Form -->
                    <div class="col-12 py-4">
                      <form method="POST" id="exam_form" class="row g-3 js-myForm">
                        
                        <div class="col-md-6">
                          <label for="exam_title" class="ms-2 fontClarity">Exam Title</label>
                          <input type="text" name="exam_title" id="exam_title" value="<?=esc($row->exam_title)?>" class="form-control <?=!empty($errors['exam_title']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Title">
                          <!-- ---- EXAM Title Error ---- -->
                          <?php if(!empty($errors['exam_title'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_title']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Title Error\. |- -->
                        </div>
                        <div class="col-md-6">
                          <label for="course_id" class="ms-2 fontClarity">Course ID</label>
                          <select name="course_id" id="course_id" class="form-select <?=!empty($errors['course_id']) ? 'border-danger' : '';?> fontClarity">
                            <option value="" selected="" disabled>Course...</option>
                            <?php if(!empty($courses)): ?>
                              <?php foreach($courses as $course): ?>
                                <option <?=set_select('course_id',$course->id,($row->course_id ?? 1))?> value="<?=$course->id?>"><?=esc($course->title)?></option>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <option value="Nothing to show">Nothing</option>
                            <?php endif; ?>
                          </select>
                          <!-- ---- COURSE_ID Error ---- -->
                          <?php if(!empty($errors['course_id'])):?>
                            <small class="text-danger fontClarity"><?=$errors['course_id']?>.</small>
                          <?php endif;?>
                          <!-- -| ./COURSE_ID Error\. |- -->
                        </div>

                        <!-- ---------| Exam Time & Duration |--------- -->
                        <div class="col-md-6">
                          <!-- ---- EXAM Time ---- -->
                          <label for="exam_datetime" class="ms-2 fontClarity">Exam Date &amp; Time</label>
                          <input type="datetime-local" name="exam_datetime" id="exam_datetime" value="<?=$row->exam_datetime ?? ''?>" class="form-control <?=!empty($errors['exam_datetime']) ? 'border-danger' : '';?> fontClarity" placeholder="Exam Date &amp; Time" rreadonly>
                          <?php if(!empty($errors['exam_datetiem'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_datetiem']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Time\. |- -->
                        </div>
                        <div class="col-md-6">
                          <!-- ---- EXAM Duration ---- -->
                          <label for="exam_duration" class="ms-2 fontClarity">Exam Duration</label>
                          <select name="exam_duration" id="exam_duration" class="form-select <?=!empty($errors['exam_duration']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Exam duration...</option>
                            <option name="exam_duration" value="5" <?=set_select('exam_duration',($row->exam_duration),5)?>>5 Minutes</option>
                            <option name="exam_duration" value="30" <?=set_select('exam_duration',($row->exam_duration),30)?>>30 Minutes</option>
                            <option name="exam_duration" value="60" <?=set_select('exam_duration',($row->exam_duration),60)?>>1 Hour</option>
                            <option name="exam_duration" value="90" <?=set_select('exam_duration',($row->exam_duration),90)?>>1 Hour &amp; 30 Minutes</option>
                            <option name="exam_duration" value="120" <?=set_select('exam_duration',($row->exam_duration),120)?>>2 Hours</option>
                            <option name="exam_duration" value="150" <?=set_select('exam_duration',($row->exam_duration),150)?>>2 Hours &amp; 30 Minutes</option>
                          </select>
                          <?php if(!empty($errors['exam_duration'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_duration']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Duration\. |- -->
                        </div>
                        <!-- -------| ./Exam Time & Duration\. |------- -->
                        
                        <!-- ---------| Exam Questions |--------- -->
                        <div class="col-md-4">
                          <label for="total_question" class="ms-2 fontClarity">Total Question</label>
                          <select name="total_question" id="total_question" class="form-select <?=!empty($errors['total_question']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Total question...</option>
                            <option name="total_question" value="5" <?=set_select('total_question',($row->total_question),5)?>>5 Questions</option>
                            <option name="total_question" value="10" <?=set_select('total_question',($row->total_question),10)?>>10 Questions</option>
                            <option name="total_question" value="15" <?=set_select('total_question',($row->total_question),15)?>>15 Questions</option>
                            <option name="total_question" value="20" <?=set_select('total_question',($row->total_question),20)?>>20 Questions</option>
                            <option name="total_question" value="25" <?=set_select('total_question',($row->total_question),25)?>>25 Questions</option>
                            <option name="total_question" value="30" <?=set_select('total_question',($row->total_question),30)?>>30 Questions</option>
                          </select>
                          <?php if(!empty($errors['total_question'])):?>
                            <small class="text-danger fontClarity"><?=$errors['total_question']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Total Questions\. |- -->
                        </div>
                        <div class="col-md-4">
                          <label for="right_answer_mark" class="ms-2 fontClarity">Right Answer Mark</label>
                          <select name="right_answer_mark" id="right_answer_mark" class="form-select <?=!empty($errors['right_answer_mark']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Right answer mark...</option>
                            <option name="right_answer_mark" value="1" <?=set_select('right_answer_mark',($row->right_answer_mark),'1')?>>+1 Mark</option>
                            <option name="right_answer_mark" value="2" <?=set_select('right_answer_mark',($row->right_answer_mark),'2')?>>+2 Mark</option>
                            <option name="right_answer_mark" value="3" <?=set_select('right_answer_mark',($row->right_answer_mark),'3')?>>+3 Mark</option>
                            <option name="right_answer_mark" value="4" <?=set_select('right_answer_mark',($row->right_answer_mark),'4')?>>+4 Mark</option>
                            <option name="right_answer_mark" value="5" <?=set_select('right_answer_mark',($row->right_answer_mark),'5')?>>+5 Mark</option>
                          </select>
                          <?php if(!empty($errors['right_answer_mark'])):?>
                            <small class="text-danger fontClarity"><?=$errors['right_answer_mark']?>.</small>
                          <?php endif;?>
                          <!-- -| ./RIGHT Answer Mark\. |- -->
                        </div>
                        <div class="col-md-4">
                          <label for="wrong_answer_mark" class="ms-2 fontClarity">Wrong Answer Mark</label>
                          <select name="wrong_answer_mark" id="wrong_answer_mark" class="form-select <?=!empty($errors['wrong_answer_mark']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Wrong answer mark...</option>
                            <option name="wrong_answer_mark" value="1" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1')?>>-1 Mark</option>
                            <option name="wrong_answer_mark" value="1.25" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1.25')?>>-1.25 Mark</option>
                            <option name="wrong_answer_mark" value="1.50" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'1.50')?>>-1.50 Mark</option>
                            <option name="wrong_answer_mark" value="2" <?=set_select('wrong_answer_mark',($row->wrong_answer_mark),'2')?>>-2 Mark</option>
                          </select>
                          <?php if(!empty($errors['wrong_answer_mark'])):?>
                            <small class="text-danger fontClarity"><?=$errors['wrong_answer_mark']?>.</small>
                          <?php endif;?>
                          <!-- -| ./WRONG Answer Mark\. |- -->
                        </div>
                        <!-- -------| ./Exam Questions\. |------- -->

                        <!-- ---------| Exam Status |--------- -->
                        <div class="col-md-6">
                          <label for="exam_status" class="ms-2 fontClarity">Exam Status</label>
                          <select name="exam_status" id="exam_status" class="form-select <?=!empty($errors['exam_status']) ? 'border-danger' : '';?>">
                            <option selected="" disabled>Choose a status...</option>
                            <option name="exam_status" value="Pending" <?=set_select('exam_status','Pending',($row->exam_status))?>>Pending</option>
                            <option name="exam_status" value="Created" <?=set_select('exam_status','Created',($row->exam_status))?>>Created</option>
                            <option name="exam_status" value="Started" <?=set_select('exam_status','Started',($row->exam_status))?>>Started</option>
                            <option name="exam_status" value="Completed" <?=set_select('exam_status','Completed',($row->exam_status))?>>Completed</option>
                          </select>
                          <?php if(!empty($errors['exam_status'])):?>
                            <small class="text-danger fontClarity"><?=$errors['exam_status']?>.</small>
                          <?php endif;?>
                          <!-- -| ./EXAM Status\. |- -->
                        </div>

                        <!-- ---------| QUESTIONS |--------- -->
                        <!-- <?=$question_button?> -->
                        <!-- <div class="col-md-6">
                          <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label><br>
                          <a href="<?=ROOT?>/admin/question/<?=$row->id?>/add" class="btn btn-sm btn-outline-info add_question" id="<?=$row->id?>">
                            <i class="bi bi-question-circle"></i> Add Question
                          </a>
                          <a href="<?=ROOT?>/admin/question/<?=$row->csrf_code?>" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-question-circle"></i> View Exam
                          </a>
                        </div> -->
                        <!-- -------| ./QUESTIONS\. |------- -->

                        <!-- ---------| Hidden Inputs |--------- -->
                        <input type="hidden" name="id" id="id" value="<?=$row->id?>">
                        <!-- <input type="hidden" name="page" value="edit_exam">
                        <input type="hidden" name="action" value="Edit"> -->
                        <!-- -------| ./Hidden Inputs\. |------- -->
                        
                        <!-- ---------| Buttons |--------- -->
                        <div class="col-md-12 text-center fontClarity">
                          <!-- <input type="submit" name="editExam" id="editExam" value="Save" class="btn btn-outline-success"> -->
                          <button type="submit" name="editExam" id="editExam" value="Save" class="btn btn-outline-success"><i class="bx bx-save"></i> Save</button>
                          <a href="<?=ROOT?>/admin/exams">
                            <button class="btn btn-outline-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                          </a>
                        </div>
                        <!-- -------| ./Buttons\. |------- -->
                      </form>  
                    </div>
                    <!-- End floating Labels Form -->

                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                </div>
              </div>
              <!-- ---| ./Edit Course Tabs\. |--- -->

            </div>
            <!-- End Customers Card -->
          </div>
          <!-- End Left side columns -->
        </div>
      </section>

    <?php else: ?>
      <div class="pagetitle row">
        <div class="col-md-6">
          <h1 class=""><?=$data['title']?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><?=$data['title']?></li>
            </ol>
          </nav>
        </div>
        <div class="col-md-6 w-50">
          <!-- ---- CHECK Page MESSAGES ---- -->
          <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
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
          </div>
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
              <div class="col-xxl-12 col-12">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <i class="bi bi-card-checklist fs-5"></i> <?=$data['title']?>
                      <a href="<?=ROOT?>/admin/exams/add" class="fontAlido">
                        <button class="btn btn-outline-primary float-end fontClarity"><i class="bi bi-card-checklist"></i> New <?=$data['title']?></button>
                      </a>
                      <a href="<?=ROOT?>/admin/courses" class="btn btn-outline-secondary float-end me-3"><i class="bi bi-box-arrow-left"></i> Back</a>
                    </h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped" id="js-exam-table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Titel</th>
                          <th scope="col">Course</th>
                          <!-- <th scope="col">Date</th> -->
                          <th scope="col">Duration</th>
                          <th scope="col">Status</th>
                          <!-- <th scope="col">Instructor</th> -->
                          <th scope="col">View</th>
                          <th scope="col">Questions</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <?php if(!empty($rows)):?>
                        <tbody>
                          <?php foreach($rows as $row):?>
                            <!-- <?=show($rows)?> -->
                            <tr>
                              <th scope="row"><?=$row->id?></th>
                              <td><?=esc($row->exam_title)?></td>
                              <td><?=esc($row->course_row->title)?></td>
                              <!-- <td><?=esc($row->exam_datetime ?? '')?></td> -->
                              <td><?=esc($row->exam_duration ?? 'NA')?></td>
                              <td><span class="badge rounded-pill bg-<?=get_badge($row->exam_status)?>"><?=esc($row->exam_status ?? 'NA')?></span></td>
                              <!-- <td><?=esc($row->user_row->name ?? 'NA')?></td> -->
                              <td>
                                <a href="<?=ROOT?>/admin/exams/view/<?=$row->id?>" class="btn btn-sm btn-warning fontAlido">
                                  View
                                </a>
                              </td>
                              <td class="text-center"><a href="<?=ROOT?>/admin/question/<?=$row->id?>" class=""><i class="bi bi-question-circle"></i></a></td>
                              <form method="post"><input type="hidden" name="target_id" value="<?=$row->id?>"></form>
                              <td class="">
                                <?php if (!is_done($row->exam_status)) : ?>
                                  <a href="<?=ROOT?>/admin/exams/edit/<?=$row->id?>">
                                    <i class="bx bx-pencil fs-5 text-success"></i> 
                                  </a>
                                <?php endif; ?>
                                <a href="<?=ROOT?>/admin/exams/delete/<?=$row->id?>">
                                  <i class="bx bx-trash fs-5 text-danger"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      <?php else:?>
                        <tr>
                          <td class="text-center text-danger" colspan="10">
                            <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
                            <a href="<?=ROOT?>/admin/courses">
                              <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                            </a>
                          </td>
                        </tr>
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

    <!-- ---- SCRIPTS ---- -->
    <script src="">
      (document).ready(function() {
        // ...| Loading Exam Data
        // let $dataTable = $('#js-exam-table').DateTable({
        //   "processing" : true,
        //   "serverSide" : true,
        //   "order" : [],
        //   "ajax" : {
        //     url: "<?=ROOT?>/../app/controllers/Admin.php",
        //     method: "POST",
        //     data:{action:'fetch', page:'exam'}
        //   },
        //   "columnDef" : [
        //     {
        //       "targets" : [6],
        //       "orderable" : false,
        //     },
        //   ],
        // });

        function reset_form() {}
        // ---| ./Reset_Form()

        let date = new Date();
        date.setDate(date.getDate());
        $('#exam_datetime').datetimepicker({
          startDate: date,
          format: 'yyyy-mm-dd hh:ii',
          autoclose: true
        });

        // Validating DATE |-----
        $('#editExam').parsley();

        // Submitting Form To Admin via AJAX
        $('#editExam').on('sumbit',function(event){
          event.preventDefault();

          // Adding a 'REQUIRED' attribute to INPUT Box |-----
          $('#exam_title').attr('required','required');
          $('#exam_datetime').attr('required','required');
          $('#exam_duration').attr('required','required');
          $('#total_question').attr('required','required');
          $('#right_answer_mark').attr('required','required');
          $('#wrong_answer_mark').attr('required','required');
        });

        // Validating FORM |-----
        if ($('#exam_form').parsley().validate()) {
          // ...| TRUE Block
          $.ajax({
            url: "<?=ROOT?>/../app/controllers/Admin.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
              $('editExam').attr('disabled','disabled');
              $('editExam').val('Validate...');
            }, // ---| ./Before Sending Ajax Request
            success: function(data) {
              if (data.success) {
                // ...| TRUE Block
                $('#message_operation').html('<div class="alert alert-success>' + data.success + '</div>');
                // RESET FORM IF Needed

                // Reload Newly Inserted Data
                dataTable.ajax.reload();

                // Enable SUBMIT Button
                $('#editExam').attr('disabled',false);

                // Changing Button Text
                $('#editExam').val($('#action').val());
              }
              // ---| ./IF(Data)
            } // ---| ./Success
          })
        }
        // ---| ./IF(Form Validate)
      });
    </script>
    <!-- -| ./SCRIPTS\. |- -->
  </main>

<!-- ======= Footer ======= -->
<?php $this->view('partials/private.footer',$data) ?>