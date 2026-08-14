<?php

/**
 * User: TECH-Tag
 * Date: 08/16/2025
 * Time: 07:37 PM
 * * *
 * @author  Marthad Musa <marthad.musa@gmail.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

use \Model\Auth;
use \Model\Slider;

/**
 * Admin()
 * *
 * The Admin Page
 */
class Admin extends Controller {
  # -----| Index() | -----
  public function index() {
    // if (!Auth::logged_in()) {
    //   # ...| TRUE Block
    //   message('Please, log in!');
    //   redirect('login');
    // }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['row'] = $row = $user->first(['id'=>$id]);

    $data['title'] = "Page not found!";

    $this->view('admin/404',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Dashboard() | -----
  public function dashboard() {
    // show($_SESSION['USER_DATA']);die;
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);
    # ---| ./User Details

    $data['students'] = $students = $user->where(['role_id'=>1]);
    $data['teachers'] = $teachers = $user->where(['role_id'=>2]);
    $data['admins']   = $admins   = $user->where(['role_id'=>3]);
    # ---| ./USERS Details

    $role = new \Model\Role();
    $roles = $role->findAll();
    $data['roles'] = array_reverse($roles);
    # ---| ./Role Details

    $course = new \Model\Course();
    $data['courses'] = $courses = $course->findAll();
    # ---| ./Course Details
    
    $course = new \Model\Exam();
    $data['exams'] = $exams = $course->findAll();
    # ---| ./Test Details

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard',$data);
  }
  # ---| ./Dashboard()\. | ---

  # -----| Users() | -----
  public function users() {
    // show($_SESSION['USER_DATA']);die;
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);
    $data['users'] = $users = $user->findAll();
    $data['users'] = array_reverse($users);
    # ---| ./User Details

    $data['students'] = $students = $user->where(['role_id'=>1]);
    $data['teachers'] = $teachers = $user->where(['role_id'=>2]);
    $data['admins']   = $admins   = $user->where(['role_id'=>3]);
    # ---| ./USERS Details

    $role = new \Model\Role();
    $roles = $role->findAll();
    $data['roles'] = array_reverse($roles);
    # ---| ./Role Details

    $data['title'] = "Users";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      if (($_POST['action'] ?? '') == 'set_role') {
        $csrf_code = $_POST['csrf_code'] ?? '';
        if (!empty($csrf_code) && $_SESSION['csrf_code'] != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $target_id = (int)($_POST['user_id'] ?? 0);
        $target = $user->first(['id'=>$target_id]);
        $new_role_id = (int)($_POST['role_id'] ?? $uid->role_id);

        if (!$target) {
          echo json_encode(['success' => false, 'message' => 'User not found.']);
          die;
        }

        if ($target->role_id == 3 && $uid->role_id != 3) {
          echo json_encode(['success' => false, 'message' => 'Only the super-admin can edit admin roles.']);
          die;
        }

        $user->update($target->id, ['role_id' => $new_role_id]);
        echo json_encode(['success' => true, 'message' => 'Role updated successfully.']);
        die;
      }
    }

    $this->view('admin/users',$data);
  }
  # ---| ./Users()\. | ---

  # -----| Exams() | -----
  public function exams($action = null, $id = null, $uid = null) {
    # ...| CHECK Log-in
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id = Auth::getId();
    $exam = new \Model\exam();
    $course = new \Model\Course();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    $question_button = '';
    $data = [];

    $uid = $uid ?? $user->first(['id'=>$user_id]);
    $data['uid'] = $uid;

    $data['action'] = $action = strtolower($action);
    $data['title'] = "Exam";

    if ($action == 'add') {
      # ...| ADD Block
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if ($exam->validate($_POST)) {
          # ...| TRUE Block
          $_POST['exam_created_on'] = date("Y-m-d H:i:s");
          $_POST['user_id'] = $user_id;
          $_POST['exam_status'] = "Created";

          $exam->insert($_POST);

          message("Exam created! Please, complete EXAM information.");
          redirect('admin/exams');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $exam->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block | Get Exam Information | -----
      $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row;
      # ---| ./Get Exam Information\. | ---

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $query = "delete from exam where id = :id limit 1";
        $exam->query($query,['id'=>$row->id]);
        message("Exam deleted successfully!");
        redirect('admin/exams');
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block | Get Exam Information | -----
      // $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $query = "select * from exam where user_id = :user_id && id = :id";
      $row = $exam->query($query,['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row[0];
      # ---| ./Get Exam Information\. | ---
      
      $id = $row->id;
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| SAVE Block 
        $exam->update($id,$_POST);
        
        message("Exam was saved successfully!");
        redirect('admin/exams');
        # ------------|  ./UPDATE()
  
        # Exam Questions  ---------------
        if ($exam->allowed_question_add($id)) {
          # ...| Adding Questions Block
          $data['question_button'] = true;
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <button type="button" name="add_question" class="btn btn-sm btn-outline-info add_question w-100" id="`.$row->id.`"><i class="bi bi-question-circle"></i> Add Question</button>
          //   </div>
          // `;
        // } else {
          # ...| Viewing Question Block
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <a href="`.ROOT.`/admin/question/`.$row->csrf_code.`" class="btn btn-sm btn-outline-warning w-100"></a>
          //   </div>
          // `;
        }
        # ---| ./IF/ELSE(Allowed Question Add)
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'view') {
      # ...| EDIT Block | Get Exam Information | -----
      // $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $query = "select * from exam where user_id = :user_id && id = :id";
      $row = $exam->query($query,['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row[0];
      # ---| ./Get Exam Information\. | ---
      
      $id = $row->id;
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| SAVE Block 
        $exam->update($id,$_POST);
        
        message("Exam was saved successfully!");
        redirect('admin/exams');
        # ------------|  ./UPDATE()
  
        # Exam Questions  ---------------
        if ($exam->allowed_question_add($id)) {
          # ...| Adding Questions Block
          $data['question_button'] = true;
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <button type="button" name="add_question" class="btn btn-sm btn-outline-info add_question w-100" id="`.$row->id.`"><i class="bi bi-question-circle"></i> Add Question</button>
          //   </div>
          // `;
        // } else {
          # ...| Viewing Question Block
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <a href="`.ROOT.`/admin/question/`.$row->csrf_code.`" class="btn btn-sm btn-outline-warning w-100"></a>
          //   </div>
          // `;
        }
        # ---| ./IF/ELSE(Allowed Question Add)
      } # ---| ./IF(POST)
      # ---| ./Action=>VIEW\. |---
    } else {
      # ...| EXAM MAIN PAGE Block
      $query = "select id, user_id, exam_title, exam_datetime, exam_duration, exam_status, course_id from exam where user_id = :user_id";
      $rows = $exam->query($query,['user_id'=>$user_id]);
      $data['rows'] = $rows;
      # ---| ./EXAM MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(Action)

    $this->view('admin/exams',$data);
  }
  # ---| ./Exams()\. | ---

  # -----| Question() | -----
  public function question($action = null, $id = null, $uid = null, $target_question = null, $target_exam = null) {
    # ...| CHECK Log-in
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id = Auth::getId();
    $exam = new \Model\Exam();
    $question = new \Model\Question();
    $question_option = new \Model\Question_option();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    $data = [];
    
    $target_exam = $exam->first(['id'=>$id]);

    $uid = $uid ?? $user->first(['id'=>$user_id]);
    $data['uid'] = $uid;

    $data['action'] = $action = strtolower($action);
    $data['title'] = "Questions";

    if ($action == 'add') {
      # ...| ADD Block
      $data['target_id'] = $target_id = str_replace('admin/question/add/','',$_GET['url']);

      $data['exam_rows'] = $exam_rows = array_reverse($exam->findAll('asc'));

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # ... SAVE Block
        if ($target_id == $_POST['exam_id']) {
          # ...| TRUE Block
          if ($_POST['add_question'] == 'save') {
            # ...| TRUE Block
            $result = $question->insert($_POST);
            $required_id = $question->get_last_id($target_id);

            if (!empty($required_id)) {
              # ...| TRUE Block
              message('Question added successfully!');
              redirect('admin/question/'.$target_id);
            }
            # ---| ./IF(RequiredID)
          }
          # ---| ./IF(SAVE)
        }
        # ---| ./IF(EXAM ID)
      } # ---| ./IF(POST)
      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block
      $data['target_question'] = $target_question = str_replace('admin/question/delete/','',$_GET['url']);
      // $data['target_id'] = $target_id = $rows->exam_id;
      $data['question_options'] = $question_options = $question_option->where(['question_id'=>$target_question]);

      $data['rows'] = $rows = $question->where(['id'=>$target_question]);
      # ---| ./Get Question Information\. | ---

      if (!empty($rows)) {
        # ...| ROWS Block
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
          # ...| DELETE Options Block
          $option_result = $question_option->delete($target_question);
          if ($option_result) {
            # ...| DELETE Question
            $question_result = $question->delete($target_question);
          }
          # ---| ./IF(Option)

          message("Question successfully deleted!");
          redirect('admin/exams');
        }
        # ---| ./IF(SERVER)
      } # ---| ./IF(ROWS)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block
      $data['target_id'] = $target_id = str_replace('admin/question/edit/','',$_GET['url']);
      $question_options = $question_option->where(['question_id'=>$target_id]);
      if (!empty($question_options)) {
        # ...| TRUE Block
        $question_options = array_reverse($question_options);
        $data['question_options'] = $question_options;
      }
      # ---| ./IF(Question Options)

      $data['exam_rows'] = $exam_rows = array_reverse($exam->findAll('asc'));

      $data['rows'] = $rows = $question->first(['id'=>$target_id]);
      $Update = false;
      $option_inputs = [];

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($rows)) {
        # ...| Post Block
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {
          # ...| Data_type = Save Block | Update Question Table |...
          $question->update($target_id,$_POST);
          $info['data'] = "";

          $options = [
            'option_number_1' => $_POST['option_number_1'],
            'option_number_2' => $_POST['option_number_2'],
            'option_number_3' => $_POST['option_number_3'],
            'option_number_4' => $_POST['option_number_4'],
          ];

          if (!empty($question_options)) {
            # ...| Check if Record is Not Empty (Update)
            $query = "update question_option set option_title = :option_title where question_id = :question_id && option_number = :option_number";

            # ...| Insert into Question Option Table |...
            for ($i=1; $i < 5; $i++) { 
              $result = $question_option->query(
                $query,[
                  'question_id'=>$target_id,
                  'option_number'=>$i,
                  'option_title'=>$options['option_number_'.$i]
                ]
              );
            }
            # ---| ./FOR(Result)
          } else {
            # ...| If Record is Empty (Insert)
            $query = "insert into question_option (question_id,option_number,option_title) values (:question_id,:option_number,:option_title)";

            # ...| Insert into Question Option Table |...
            foreach ($options as $key => $option) {
              # ...| Insert New Record
              $option_inputs = [
                'option_number'=>str_replace('option_number_','',$key),
                'option_title'=>$_POST['option_number'.str_replace('option_number','',$key)]
              ];
              $result = $question_option->query($query,['question_id'=>$target_id,'option_number'=>$option_inputs['option_number'],'option_title'=>$option_inputs['option_title']]);
            }
            # ---| ./FOREACH(Options)
          }
          # ---| ./IF/ELSE(Options)

          $info['data_type'] = "save";
          $info['data_url'] = $rows->exam_id;
          echo json_encode($info);die;

          // if ($Update) {
          //   # ...| Everything SAVED
          //   message("Your question was updated seccessfully!");
          //   redirect('admin/question/'.$rows->exam_id);
          // }
          // # ---| ./IF(EDIT Result)
        }
        # ---| ./IF(Data_Type = SAVE)

        // die;
      }
      # ---| ./IF(POST)

      $data['errors'] = $question->errors;

      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'view') {
      # ...| EDIT Block
      $data['target_id'] = $target_id = str_replace('admin/question/view/','',$_GET['url']);
      $question_options = $question_option->where(['question_id'=>$target_id]);
      if (!empty($question_options)) {
        # ...| TRUE Block
        $question_options = array_reverse($question_options);
        $data['question_options'] = $question_options;
      }
      # ---| ./IF(Question Options)

      $data['exam_rows'] = $exam_rows = array_reverse($exam->findAll('asc'));

      $data['rows'] = $rows = $question->first(['id'=>$target_id]);

      $data['errors'] = $question->errors;
      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| Question MAIN PAGE Block
      $target_id = str_replace('admin/question/','',$_GET['url']);
      $data['target_id'] = $target_id;

      $query = "select * from question where exam_id = :exam_id";
      $rows = $question->query($query,['exam_id'=>$target_id]);
      $data['rows'] = $rows;
      $data['exam_total_question'] = $exam_total_question = $exam->get_exam_question_limit($target_id);
    }
    # ---| ./IF/ELSE(Action)

    $this->view('admin/question',$data);
  }
  # ---| ./Question()\. | ---

  # -----| Courses() | -----
  public function courses($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $course = new \Model\Course();
    $category = new \Model\Category();
    $language = new \Model\Language_model();
    $level = new \Model\Level_model();
    $price = new \Model\Price_model();
    $currency = new \Model\Currency_model();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    $data = [];

    // Refresh date-driven course status logic in controllers.
    update_course_status_from_date();

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Courses";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      if (($_POST['action'] ?? '') == 'set_course_status') {
        $csrf_code = $_POST['csrf_code'] ?? '';
        if (!empty($csrf_code) && $_SESSION['csrf_code'] != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $course_id = (int)($_POST['course_id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $row = $course->first(['id'=>$course_id]);

        if (!$row) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $flags = course_status_flags($status);
        $course->update($row->id, $flags);

        echo json_encode(['success' => true, 'message' => 'Course status updated to '.$status]);
        die;
      }
    }

    if ($action == 'add') {
      # ...| ADD Block
      $data['categories'] = $category->findAll('asc');

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if ($course->validate($_POST)) {
          # ...| TRUE Block
          $_POST['create_date'] = date("Y-m-d H:i:s");
          $_POST['user_id'] = $user_id;
          // $_POST['price_id'] = 1;

          $course->insert($_POST);

          /**
           * To fetch the very LAST Course inserted by THIS EXACT USER
           */
          $row = $course->first(['user_id'=>$user_id,'published'=>0]);
          message("Your course was created seccessfully!");

          if ($row) {
            # ...| TRUE Block
            redirect('admin/courses/edit/'.$row->id);
          } else {
            # ...| FALSE Block
            message("There's was an issue and your course was not created!");
            redirect('admin/courses');
          }
          # ---| ./IF/ELSE(ROW)
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $course->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block
      $categories = $category->findAll('asc');
      $languages = $language->findAll('asc');
      $levels = $level->findAll('asc');
      $prices = $price->findAll('asc');
      $currencies = $currency->findAll('asc');

      # -----| Get Course Information | -----
      $data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $course_meta = new \Model\Course_meta();
        $course_lecture = new \Model\Course_lecture();

        $meta_rows = $course_meta->where(['course_id'=>$row->id]);
        if ($meta_rows) {
          foreach ($meta_rows as $meta_row) {
            if (!empty($meta_row->lectures_row)) {
              foreach ($meta_row->lectures_row as $lecture) {
                $course_lecture->delete($lecture->id);
              }
            }
            $course_meta->delete($meta_row->id);
          }
        }

        $course->delete($row->id);
        message("Courses deleted successfully!");
        redirect('admin/courses');
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'status') {
      # ...| STATUS Block
      $data['row'] = $row = $course->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        $status = $_POST['status'] ?? '';
        $flags = course_status_flags($status);
        $course->update($row->id, $flags);
        message("Course status updated to $status");
        redirect('admin/courses');
      }
      # ---| ./Action=>STATUS\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block
      $data['categories'] = $categories = array_reverse($category->findAll('asc'));
      $data['languages'] = $languages = array_reverse($language->findAll('asc'));
      $data['levels'] = $levels = array_reverse($level->findAll('asc'));
      $data['prices'] = $prices = array_reverse($price->findAll('asc'));
      $data['currencies'] = $currencies = array_reverse($currency->findAll('asc'));

      /**
       * --------------------------
       * | Get Course Information |
       * --------------------------
       */
      $data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "read") {
          # ...| READ Process Block
          if ($_POST['tab_name'] == "intended-learners") {
            # ...| Intended Learners Block
            include views_path('course-edit-tabs/intended-learners');
          } else
          if ($_POST['tab_name'] == "curriculum") {
            # ...| Curriculum Block
            include views_path('course-edit-tabs/curriculum');
          } else
          if ($_POST['tab_name'] == "course-landing-page") {
            # ...| Course Landing Page Block
            include views_path('course-edit-tabs/course-landing-page');
          } else
          if ($_POST['tab_name'] == "course-duration") {
            # ...| Promotion Block
            include views_path('course-edit-tabs/course-duration');
          } else
          if ($_POST['tab_name'] == "course-messages") {
            # ...| Course Messages Block
            include views_path('course-edit-tabs/course-messages');
          }
          # ---| ./IF/ELSE/IF(Tab_Name)
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "get-meta") {
          # ...| Get-Meta Process Block
          $course_meta = new \Model\Course_meta();

          $rows = $course_meta->where(['course_id'=>$_POST['course_id'],'disabled'=>0]);

          $info['data'] = [];
          if ($rows) {
            # ...| TRUE Block
            $course_lecture = new \Model\Course_lecture;

            foreach ($rows as $akey => $course_meta_row) {
              $row_lectures = $course_lecture->where(['unid'=>$course_meta_row->unid,'disabled'=>0]);

              if ($row_lectures) {
                # ...| TRUE Block
                foreach ($row_lectures as $vid_key => $vid_row) {
                  $row_lectures[$vid_key]->base_file = $vid_row->file;
                  $row_lectures[$vid_key]->file = get_video($vid_row->file);
                }
                # ---| ./FOREACH(ROW Lectures)

                $rows[$akey]->lectures = $row_lectures;
              }
              # ---| ./IF(Row Lectures)
            }
            # ---| ./FOREACH(Rows)

            $info['data'] = $rows;
          }
          # ---| ./IF(ROWS)

          $info['data_type'] = "get-meta";

          echo json_encode($info);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {
          # ...| SAVE Process Block | \Check if Form is Valid, Invalide, Expired, Took Too-Long Time/ |------ **/
          if ($_SESSION['csrf_code'] == $_POST['csrf_code']) {
            # ...| TRUE Block
            if ($course->edit_validate($_POST,$id,$_POST['tab_name'])) {
              # ...| TAB SAVE Block
              if ($_POST['tab_name'] == "intended-learners") {
                # ...| TAB: (Intended Learners) Block
                $course_meta = new \Model\Course_meta();
                $meta_data = [];

                foreach ($_POST as $key => $value) {
                  if (!empty($value) && preg_match("/^[a-zA-Z\-]+_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $key = preg_replace("/_[0-9]+$/", "", $key);
                    $meta_data[$key][] = $value;
                  }
                  # ---| ./IF(Meta_DATA)
                }
                # ---| ./FOREACH()

                /**
                 * ------------------------------------------------
                 * | Disable All Records from a Certain Course_ID |
                 * ------------------------------------------------
                 */
                $old_records = $course_meta->where(['course_id'=>$id,'tab'=>$_POST['tab_name']]);
                $old_ids = [];
                if ($old_records) {
                  # ...| TRUE Block
                  $old_ids = array_column($old_records, 'id');
                  foreach ($old_records as $record) {
                    $course_meta->update($record->id,['disabled'=>1]);
                  }
                  # ---| ./FOREACH(Old_Records)
                }
                # ---| ./IF(Old_Records)

                if (!empty($meta_data)) {
                  # ...| True Block
                  foreach ($meta_data as $key => $rows) {
                    # ...| Grouping the KEY as a Column
                    $data_type = $key;
                    foreach ($rows as $value) {
                      $arr = [];
                      $arr['tab'] = $_POST['tab_name'];
                      $arr['data_type'] = $data_type;
                      $arr['course_id'] = $id;
                      $arr['value'] = $value;
                      // $arr['unid'] = $_POST['unid'];
                      $arr['disabled'] = 0;
                      
                      if (count($old_ids) > 0) {
                        # ...| TRUE Block | UPDATE |---
                        $my_old_ids = array_pop($old_ids);
                        $course_meta->update($my_old_ids, $arr);
                      } else {
                        # ...| FALSE Block | INSERT |---
                        $arr['unid'] = time().rand(100,999);
                        /**
                         * Check if the UniqueID is not stored in DB
                        */
                        while ($course_meta->where(['unid'=>$arr['unid']])) {
                          $arr['unid'] = time().rand(100,999);
                        }
                        # ---| ./WHILE(UNID)
                        $course_meta->insert($arr);
                      }
                      # ---| ./IF/ELSE(Old_IDs)
                    }
                    # ---| ./FOREACH(ROWS)
                  }
                  # ---| ./FOREACH(Meta_data)
                }
                # ---| ./ IF(Meta_data)

                $info['data'] = "Course saved successfully!";
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "curriculum") {
                # ...| TAB: (Curriculum) Block
                $course_meta = new \Model\Course_meta();
                $course_lecture = new \Model\Course_lecture;

                $meta_data = [];
                $meta_data_unids = [];
                $meta_data_descriptions = [];
                $meta_data_index = [];

                $lecture_data = [];
                $lecture_data_unids = [];
                $lecture_data_descriptions = [];
                $lecture_data_files = [];
                $lecture_data_new_files = [];
                $lecture_data_index = [];

                foreach ($_POST as $key => $value) {
                  /**
                   * ----------------
                   * | For Curriculum Sections |
                   * ----------------
                   */
                  if (!empty($value) && preg_match("/^curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^curriculum_/", "", $key);
                    $meta_data[$mainkey][$subkey] = $value;
                  } else
                  # ---| ./IF(Meta_DATA)

                  if (!empty($value) && preg_match("/^unid_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^unid_curriculum_/", "", $key);
                    $meta_data_unids[$mainkey][$subkey] = $value;
                  } else
                  # ---| ./IF(Meta_DATA)

                  if (!empty($value) && preg_match("/^description_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^description_curriculum_/", "", $key);
                    $meta_data_descriptions[$mainkey][$subkey] = $value;
                  }
                  # ---| ./IF/ELSE/IF(Meta_DATA)

                  /**
                   * ----------------
                   * | For Lectures |
                   * ----------------
                   */
                  if (preg_match("/^lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $key = preg_replace("/^lecture_[0-9]+_curriculum_/", "", $key);
                    $lecture_data[$key][] = $value;
                  }
                  # ---| ./IF(Curriculum)

                  if (preg_match("/^description_lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $key = preg_replace("/^description_lecture_[0-9]+_curriculum_/", "", $key);
                    $lecture_data_descriptions[$key][] = $value;
                  }
                  # ---| ./IF(Lecture Description)

                  if (preg_match("/^file_lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $key = preg_replace("/^file_lecture_[0-9]+_curriculum_/", "", $key);
                    $lecture_data_files[$key][] = $value;
                    $lecture_data_new_files[$key][] = "";

                    /**
                     * -----------------------------
                     * | Check for NEW Video Files |
                     * -----------------------------
                     */
                    foreach ($_FILES as $newKey => $file) {
                      if (preg_match("/^new_file_lecture_[0-9]+_curriculum_{$key}$/", $newKey)) {
                        # ...| TRUE Block
                        $filename = "";
                        $folder = "uploads/courses/";
                        if (!file_exists($folder)) {
                          # ...| TURE Block
                          mkdir($folder,0777,true);
                        }
                        # ---| ./IF(Folder)
                        
                        if (!empty($file['name'])) {
                          # ...| TRUE Block
                          $filename = $folder . time() . $file['name'];
                          move_uploaded_file($file['tmp_name'], $filename);
                        }
                        # ---| ./IF(FILE)
    
                        $thiskey = str_replace(['new_file_lecture_', '_curriculum_'.$key], "", $newKey);
                        $lecture_data_new_files[$key][$thiskey] = $filename;
                      }
                      # ---| ./IF(Lecture File)
                    }
                    # ---| ./FOREACH(FILES)
                  }
                  # ---| ./IF(Lecture File)
                }
                # ---| ./FOREACH()

                /**
                 * ------------------------------------------------
                 * | Disable All Records from a Certain Course_ID |
                 * ------------------------------------------------
                 */
                $old_records = $course_meta->where(['course_id'=>$id,'tab'=>$_POST['tab_name']]);
                $old_ids = [];
                if ($old_records) {
                  # ...| TRUE Block
                  $old_ids = array_column($old_records, 'id');
                  foreach ($old_records as $record) {
                    $course_meta->update($record->id,['disabled'=>1]);
                  }
                  # ---| ./FOREACH(Old_Records)
                }
                # ---| ./IF(Old_Records)

                if (!empty($meta_data)) {
                  # ...| True Block
                  foreach ($meta_data as $key => $rows) {
                    # ...| Grouping the KEY as a Column
                    $data_type = $key;
                    foreach ($rows as $key2 => $value) {
                      $arr = [];
                      $arr['data_type'] = $data_type;
                      $arr['course_id'] = $id;
                      $arr['value'] = $value;
                      $arr['disabled'] = 0;
                      $arr['tab'] = $_POST['tab_name'];

                      if (!empty($meta_data_unids['unid_'.$key][$key2])) {
                        # ... TRUE Block
                        $arr['unid'] = $meta_data_unids['unid_'.$key][$key2];
                      }

                      if (!empty($meta_data_descriptions['description_'.$key][$key2])) {
                        # ... TRUE Block
                        $arr['description'] = $meta_data_descriptions['description_'.$key][$key2];
                      }
                      # ---| ./IF()

                      if (count($old_ids) > 0) {
                        # ...| TRUE Block | UPDATE |---
                        $my_old_ids = array_pop($old_ids);
                        $course_meta->update($my_old_ids, $arr);
                      } else {
                        # ...| FALSE Block | INSERT |---
                        $arr['unid'] = time().rand(100,999);
                        /**
                         * ---------------------------------------------
                         * | Check if the UniqueID is not stored in DB |
                         * ---------------------------------------------
                        */
                        while ($course_meta->where(['unid'=>$arr['unid']])) {
                          $arr['unid'] = time().rand(100,999);
                        }
                        # ---| ./WHILE(UNID)

                        $course_meta->insert($arr);
                      }
                      # ---| ./IF/ELSE(Old_IDs)

                      /**
                       * --------------------------
                       * | SAVE to Lectures Table |
                       * --------------------------
                       */
                      if (!empty($lecture_data[$key2])) {
                        # ...| TRUE Block
                        $myunid = $arr['unid'] ?? time().rand(100,999);

                        /**
                         * --------------------------------------------------
                         * | Disable All Records from Course Lectures Table |
                         * --------------------------------------------------
                         */
                        $old_lecture_records = $course_lecture->where(['unid'=>$myunid]);
                        $old_lecture_ids = [];
                        if ($old_lecture_records) {
                          # ...| TRUE Block
                          $old_lecture_ids = array_column($old_lecture_records, 'id');
                          $old_lecture_files = array_column($old_lecture_records, 'file');

                          foreach ($old_lecture_records as $record) {
                            $course_lecture->update($record->id,['disabled'=>1]);
                          }
                          # ---| ./FOREACH(Old_Records)
                        }
                        # ---| ./IF(Old_Records)

                        foreach ($lecture_data[$key2] as $key3 => $lec_title) {
                          # ...| Lectures Block
                          $arr = [];
                          $arr['unid'] = $myunid;
                          $arr['disabled'] = 0;
                          $arr['title'] = $lec_title;
                          $arr['description'] = $lecture_data_descriptions[$key2][$key3] ?? "";
                          $arr['file'] = $lecture_data_new_files[$key2][$key3] ?? "";

                          $delete_old_file = false;
                          $old_filename = "";
                          if (empty($arr['file'])) {
                            # ...| TRUE Block
                            $arr['file'] = $lecture_data_files[$key2][$key3] ?? "";
                          } else {
                            # ...| FALSE Block | Remove Old Video |---
                            $delete_old_file = true;
                            $old_filename = $lecture_data_files[$key2][$key3] ?? "";
                          }
                          # ---| ./IF/ELSE(File)

                          if (count($old_lecture_ids) > 0) {
                            # ...| TRUE Block | UPDATE |---
                            $my_old_lecture_ids = array_pop($old_lecture_ids);
                            $course_lecture->update($my_old_lecture_ids, $arr);

                            /**
                             * ---------------------------------
                             * | Delete Old Video Files exists |
                             * ---------------------------------
                             */
                            if ($delete_old_file && file_exists($old_filename)) {
                              # ...| TRUE Block
                              unlink($old_filename);
                            }
                            # ---| ./IF(Delete_Old_File)
                          } else {
                            # ...| FALSE Block | SAVE |---
                            $course_lecture->insert($arr);
                          }
                          # ---| ./IF/ELSE(Old_IDs)
                        }
                        # ---| ./FOREACH(Lecture Name)
                      }
                      # ---| ./IF(Lecture)
                    }
                    # ---| ./FOREACH(ROWS)
                  }
                  # ---| ./FOREACH(Meta_data)
                }
                # ---| ./ IF(Meta_data)

                $info['data'] = "Course saved successfully!";
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "course-landing-page") {
                # ...| TAB: (Course Landing Page) Block
                if ($row->course_image_tmp != "" && file_exists($row->course_image_tmp) && $row->csrf_code == $_POST['csrf_code']) {
                  # --/ Check if TMP Image exists.. then, Move it to an Image location \--
                  if (file_exists($row->course_image)) {
                    # ...| Delete Current Course Image Block
                    unlink($row->course_image);
                  }
                  # ---| ./IF(FILE Exists)
    
                  $_POST['course_image'] = $row->course_image_tmp;
                  $_POST['course_image_tmp'] = "";
                }
                # ---| ./IF(TMP Image)
    
                $course->update($id,$_POST);
    
                $info['data'] = "Course saved successfully!";
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "course-duration") {
                # ...| TAB: (Course Duration) Block
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  $course->update($id,$_POST);

                  $info['data'] = "Course saved successfully!";
                  $info['data_type'] = "save";
                }
                # ---| ./IF(POST)
              } else
              if ($_POST['tab_name'] == "course-messages") {
                # ...| TAB: (Course Messages) Block
              }
              # ---| ./IF/ELSE/IF(TAB)
            } else {
              # ...| FALSE Block
              $info['errors'] = $course->errors;
              $info['data'] = "Please, fix all errors!";
              $info['data_type'] = "save";
            }
            # ---| ./IF/ELSE(VALIDATE)
          } else {
            # ...| FLASE Block
            $info['errors'] = ['key'=>'value'];
            $info['data'] = "Oh, NO! This form is not valid.";
            $info['data_type'] = $_POST['data_type'];
          }
          # ---| ./IF/ELSE(Security_Code)

          echo json_encode($info);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_image") {
          # ...| TRUE Block
          $folder = "uploads/courses/";
          if (!file_exists($folder)) {
            # ...| TURE Block
            mkdir($folder,0777,true);
            // file_put_contents($folder."index.php", "<?php //Silence");
            // file_put_contents("uploads/index.php", "<?php //Silence");
          }
          # ---| ./IF(Folder)

          $errors = [];
          if (!empty($_FILES['image']['name'])) {
            # ...| TRUE Block
            $destination = $folder . time() . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            /* -----| DELETE OLD tmp FILE |----- */
            if (file_exists($row->course_image_tmp)) {
              # ...| TRUE Block
              unlink($row->course_image_tmp);
            }
            # ---| ./IF(TMP)
            
            /* -----| SAVE NEW tmp FILE |----- */
            $course->update($id,['course_image_tmp'=>$destination,'csrf_code'=>$_POST['csrf_code']]);
            // echo "Upload Complete!";
          }
          # ---| ./IF(Image)

          // show($_FILES);
          // show($_POST);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_video") {
          # ...| TRUE Block
          $folder = "uploads/courses/";
          if (!file_exists($folder)) {
            # ...| TRUE Block
            mkdir($folder,0777,true);
          }

          if (!empty($_FILES['video']['name'])) {
            # ...| TRUE Block
            $destination = $folder . time() . basename($_FILES['video']['name']);
            if (move_uploaded_file($_FILES['video']['tmp_name'], $destination)) {
              if (!empty($row->course_promo_video) && file_exists($row->course_promo_video)) {
                unlink($row->course_promo_video);
              }

              $course->update($id,['course_promo_video'=>$destination,'csrf_code'=>$_POST['csrf_code']]);
            }
          }
        }
        # ---| ./IF/ELSE/IF(Data_Type)

        die;
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'course') {
      # ...| Single-COURSE Block
      $data['rows'] = $course->findAll();
    } elseif ($action == 'lecture') {
      # ...| Single-COURSE Block
      $data['rows'] = $course->findAll();
    } else {
      # ...| ALL My Courses Block
      $course->limit = 100;

      if ($uid->role_id == 3) {
        $data['approved_courses'] = $course->where(['approved'=>1,'published'=>1]);
        $data['rows'] = $course->findAll();
      } elseif ($uid->role_id == 2) {
        $data['approved_courses'] = $course->where(['user_id'=>$user_id,'approved'=>1,'published'=>1]);
        $data['rows'] = $course->where(['user_id'=>$user_id,'approved'=>0,'published'=>0]);
      } else {
        $data['approved_courses'] = $course->where(['approved'=>1,'published'=>1]);
        $data['rows'] = [];
      }
      # ---| ./COURSES MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/courses',$data);
  }
  # ---| ./Courses()\. | ---

  # -----| Lessons() | -----
  public function lessons() {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id    = Auth::getId();
    $course     = new \Model\Course();
    $enrollment = new \Model\Enrollment();
    $course_request = new \Model\Course_join_request();
    $course_meta = new \Model\Course_meta();
    $course_lecture = new \Model\Course_lecture();
    $user       = new \Model\User();

    $data = [];
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $approved_courses = $course->where(['approved'=>1,'published'=>1]);
    $data['approved_courses'] = $approved_courses ?: [];

    $teacher_courses = $course->where(['user_id'=>$user_id,'approved'=>1,'published'=>1]);
    $data['teacher_courses'] = $teacher_courses ?: [];

    $student_approved_requests = $course_request->where(['user_id'=>$user_id,'status'=>'Approved']);
    $student_courses = [];
    if ($student_approved_requests) {
      foreach ($student_approved_requests as $request) {
        $course_row = $course->first(['id'=>$request->course_id,'approved'=>1,'published'=>1]);
        if ($course_row) {
          $student_courses[] = $course_row;
        }
      }
    }
    $data['student_courses'] = $student_courses;

    $enrolled = $enrollment->where(['user_id'=>$user_id,'disabled'=>0]);
    $rows = [];
    if ($enrolled) {
      foreach ($enrolled as $er) {
        $c = $course->first(['id'=>$er->course_id]);
        if ($c) $rows[] = $c;
      }
    }
    $data['rows'] = $rows;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      $action = $_POST['action'] ?? '';

      if ($action == 'load_course_requests') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $selected_course = $course->first(['id'=>$course_id,'approved'=>1,'published'=>1]);

        if (!$selected_course) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $requests = $course_request->where(['course_id'=>$course_id]);
        $rows_html = '<div class="card"><div class="card-body"><h6 class="card-title">Enrollment requests for '.esc($selected_course->title).'</h6>';

        if ($requests) {
          $rows_html .= '<div class="table-responsive"><table class="table table-bordered align-middle"><thead><tr><th>Student</th><th>Status</th><th>Action</th></tr></thead><tbody>';
          foreach ($requests as $request) {
            $student = $user->first(['id'=>$request->user_id]);
            $status = $request->status ?? 'Pending';
            $rows_html .= '<tr>';
            $rows_html .= '<td>'.esc($student->firstname ?? 'Student').' '.esc($student->lastname ?? '').'</td>';
            $rows_html .= '<td><span class="badge bg-'.($status == 'Approved' ? 'success' : ($status == 'Rejected' ? 'danger' : 'warning')).'">'.esc($status).'</span></td>';
            $rows_html .= '<td>';
            $rows_html .= '<form method="post" class="d-inline-block request-status-form" data-course-id="'.$course_id.'" data-request-user-id="'.$request->user_id.'">';
            $rows_html .= '<input type="hidden" name="csrf_code" value="'.($_SESSION['csrf_code'] ?? '').'">';
            $rows_html .= '<select name="status" class="form-select form-select-sm d-inline-block" style="width:auto;min-width:120px;">';
            $rows_html .= '<option value="Pending" '.($status == 'Pending' ? 'selected' : '').'>Pending</option>';
            $rows_html .= '<option value="Approved" '.($status == 'Approved' ? 'selected' : '').'>Approve</option>';
            $rows_html .= '<option value="Rejected" '.($status == 'Rejected' ? 'selected' : '').'>Reject</option>';
            $rows_html .= '</select>';
            $rows_html .= '<button type="submit" class="btn btn-sm btn-primary ms-2">Save</button>';
            $rows_html .= '</form>';
            $rows_html .= '</td>';
            $rows_html .= '</tr>';
          }
          $rows_html .= '</tbody></table></div>';
        } else {
          $rows_html .= '<div class="alert alert-light border">No student requests for this course yet.</div>';
        }

        $rows_html .= '</div></div>';

        echo json_encode(['success' => true, 'html' => $rows_html]);
        die;
      }

      if ($action == 'load_student_course') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $selected_course = $course->first(['id'=>$course_id,'approved'=>1,'published'=>1]);

        if (!$selected_course) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $course_sections = $course_meta->where(['course_id'=>$course_id,'disabled'=>0]);
        $sections_html = '<div class="list-group">';
        if ($course_sections) {
          foreach ($course_sections as $section) {
            $lecture_items = $course_lecture->where(['unid'=>$section->unid,'disabled'=>0]);
            $sections_html .= '<div class="list-group-item">';
            $sections_html .= '<strong>'.esc($section->value ?? 'Section').'</strong>';
            if ($lecture_items) {
              $sections_html .= '<ul class="mb-0 mt-2 ps-3">';
              foreach ($lecture_items as $lecture) {
                $sections_html .= '<li>'.esc($lecture->title).'</li>';
              }
              $sections_html .= '</ul>';
            }
            $sections_html .= '</div>';
          }
        } else {
          $sections_html .= '<div class="list-group-item">No course sections found.</div>';
        }
        $sections_html .= '</div>';

        $other_courses = array_filter($student_courses, function($item) use ($course_id) {
          return $item->id != $course_id;
        });

        $other_html = '<div class="list-group">';
        if ($other_courses) {
          foreach ($other_courses as $other_course) {
            $other_html .= '<a href="#" class="list-group-item list-group-item-action">'.esc($other_course->title).'</a>';
          }
        } else {
          $other_html .= '<div class="list-group-item">No other approved courses.</div>';
        }
        $other_html .= '</div>';

        $html = '<div class="row g-3"><div class="col-lg-4"><div class="card"><div class="card-body"><h6 class="card-title">'.esc($selected_course->title).'</h6><p class="small text-muted">'.esc($selected_course->description ?? 'No description available').'</p>'.$sections_html.'</div></div></div><div class="col-lg-4"><div class="card"><div class="card-body"><video class="w-100" controls><source src="'.get_image($selected_course->course_promo_video ?: $selected_course->course_image).'" type="video/mp4"></video></div></div></div><div class="col-lg-4"><div class="card"><div class="card-body"><h6 class="card-title">Other approved courses</h6>'.$other_html.'</div></div></div></div>';

        echo json_encode(['success' => true, 'html' => $html]);
        die;
      }

      if ($action == 'update_request_status') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $user_id = (int)($_POST['user_id'] ?? 0);
        $status = trim($_POST['status'] ?? 'Pending');
        $csrf_code = $_POST['csrf_code'] ?? '';

        if (!empty($csrf_code) && ($_SESSION['csrf_code'] ?? '') != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $request = $course_request->first(['course_id'=>$course_id,'user_id'=>$user_id]);
        if (!$request) {
          $course_request->insert([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'status' => $status,
            'requested_at' => date('Y-m-d H:i:s'),
            'approved_by' => $user_id,
            'approved_at' => ($status == 'Approved') ? date('Y-m-d H:i:s') : null,
            'disabled' => 0,
          ]);
          echo json_encode(['success' => true, 'message' => 'Enrollment request updated.']);
          die;
        }

        $course_request->update($request->id, [
          'status' => $status,
          'approved_by' => $user_id,
          'approved_at' => ($status == 'Approved') ? date('Y-m-d H:i:s') : null,
          'disabled' => 0,
        ]);

        if ($status == 'Approved') {
          $exists = $enrollment->first(['user_id'=>$user_id,'course_id'=>$course_id]);
          if (!$exists) {
            $enrollment->insert([
              'user_id' => $user_id,
              'course_id' => $course_id,
              'disabled' => 0,
            ]);
          }
        }

        echo json_encode(['success' => true, 'message' => 'Request status saved.']);
        die;
      }
    }

    $data['title'] = "Enrolled Courses";

    $this->view('admin/lessons',$data);
  }
  # ---| ./Lessons()\. | ---

  # -----| Lectures() | -----
  public function lectures($action = null, $id = null) {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    $user_id = Auth::getId();
    $course_lecture = new \Model\Course_lecture();
    $course_meta = new \Model\Course_meta();
    $course = new \Model\Course();
    $user = new \Model\User();

    $data = [];
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['title'] = "Lectures";
    $data['action'] = $action;
    $data['id'] = $id;

    if ($action == 'add') {
      $sections = $course_meta->query("select distinct cm.unid, cm.course_id, c.title as course_title from courses_meta cm left join courses c on cm.course_id = c.id where cm.disabled = 0 order by c.title asc");
      $data['sections'] = $sections;

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lecture_data = [
          'unid' => $_POST['unid'] ?? null,
          'title' => trim($_POST['title'] ?? ''),
          'description' => trim($_POST['description'] ?? ''),
          'disabled' => 0,
        ];

        if (empty($lecture_data['unid']) || empty($lecture_data['title'])) {
          $data['errors']['lecture'] = "Please select a section and provide a lecture title.";
        } else {
          $filename = "";
          if (!empty($_FILES['file']['name'])) {
            $folder = "uploads/courses/";
            if (!file_exists($folder)) {
              mkdir($folder,0777,true);
            }
            $filename = $folder . time() . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
          }
          $lecture_data['file'] = $filename;
          $course_lecture->insert($lecture_data);
          message("Lecture created successfully!");
          redirect('admin/lectures');
        }
      }

      $this->view('admin/lectures',$data);
      return;
    }

    if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $row = $course_lecture->first(['id'=>$id]);
      if ($row) {
        $course_lecture->delete($row->id);
        message("Lecture deleted successfully!");
      }
      redirect('admin/lectures');
    }

    $query = "select cl.*, cm.course_id, cm.tab, cm.data_type from courses_lectures cl left join courses_meta cm on cl.unid = cm.unid group by cl.id order by cl.id desc";
    $rows = $course_lecture->query($query);
    $data['rows'] = array_reverse($rows);

    $this->view('admin/lectures',$data);
  }
  # ---| ./Lectures()\. | ---

  # -----| Quizzes() | -----
  public function quizzes($action = null, $id = null) {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    $user_id = Auth::getId();
    $exam = new \Model\Exam();
    $course = new \Model\Course();

    $data = [];
    $data['title'] = "Quizzes";

    if ($action == 'add') {
      redirect('admin/exams/add');
    }

    if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $row = $exam->first(['id'=>$id, 'user_id'=>$user_id]);
      if ($row) {
        $exam->delete($row->id);
        message("Quiz deleted successfully!");
      }
      redirect('admin/quizzes');
    }

    $data['rows'] = $exam->query("select * from exam where user_id = :user_id order by id desc", ['user_id'=>$user_id]);
    $data['courses'] = $course->findAll();

    $this->view('admin/quizzes',$data);
  }
  # ---| ./Quizzes()\. | ---

  # -----| Categories() | -----
  public function categories($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $category = new \Model\Category();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    // $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Categories";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_categories')) {
          # ...| TRUE Block
          if ($category->validate($_POST)) {
            # ...| TRUE Block
            $_POST['slug'] = str_to_url($_POST['category']);
            $category->insert($_POST);
            message("Your category was created seccessfully!");
            redirect('admin/categories');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $category->errors['category'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Category Information | -----
      $data['row'] = $row = $category->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $category->delete($row->id);
        message("Your category was deleted seccessfully!");
        redirect('admin/categories');

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Category Information | -----
      $data['row'] = $row = $category->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($category->validate($_POST)) {
          # ...| TRUE Block
          $category->update($row->id, $_POST);
          message("Your category was updated seccessfully!");
          redirect('admin/categories');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| ALL Categories Block
      $data['rows'] = $category->findAll();
      # ---| ./Category MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/categories',$data);
  }
  # ---| ./Categories()\. | ---

  # -----| Prices() | -----
  public function prices($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $price = new \Model\Price_model();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Prices";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_prices')) {
          # ...| TRUE Block
          if ($price->validate($_POST)) {
            # ...| TRUE Block
            // $_POST['slug'] = str_to_url($_POST['price']);
            $price->insert($_POST);
            message("Your price was created seccessfully!");
            redirect('admin/prices');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $price->errors['price'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Price Information | -----
      $data['row'] = $row = $price->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $price->delete($row->id);
        message("Your price was deleted seccessfully!");
        redirect('admin/prices');

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Price Information | -----
      $data['row'] = $row = $price->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($price->validate($_POST)) {
          # ...| TRUE Block
          $price->update($row->id, $_POST);
          message("Your price was updated seccessfully!");
          redirect('admin/prices');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| ALL Prices Block
      $data['rows'] = $price->findAll();
      # ---| ./Price MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/prices',$data);
  }
  # ---| ./Prices()\. | ---

  # -----| Roles() | -----
  public function roles($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $role = new \Model\Role();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    // $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Roles";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_permissions')) {
          # ...| TRUE Block
          if ($role->validate($_POST)) {
            # ...| TRUE Block
            $_POST['slug'] = str_to_url($_POST['role']);
            $role->insert($_POST);
            message("Your role was created seccessfully!");
            redirect('admin/roles');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $role->errors['role'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Category Information | -----
      $data['row'] = $row = $role->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $role->delete($row->id);
        message("Your role was deleted seccessfully!");
        redirect('admin/roles');

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Category Information | -----
      $data['row'] = $row = $role->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($role->validate($_POST)) {
          # ...| TRUE Block
          $role->update($row->id, $_POST);
          message("Your role was updated seccessfully!");
          redirect('admin/roles');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| Roles Block
      $data['rows'] = $role->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block -----| Disable ALL Permissions |-----
        $query = "update permissions_map set disabled = 1 where id > 0";
        $role->query($query);
        
        foreach ($_POST as $key => $permission) {
          if (preg_match("/[0-9]+\_[0-9]+/", $key)) {
            # ...| TRUE Block
            $role_id = preg_replace("/\_[0-9]+/", "", $key);
            
            /**
             * ------------------------------------------------- 
             * | Instead of using the DATABASE() Model() to    |
             * | use query() Method, Use the ROLE() Model      |
             * | Which Extends and provide all Model() Methods |
             * | THEN, INSERT INTO Permisssions_Map Table      |
             * -------------------------------------------------
             */
            $arr = [];
            $arr['role_id'] = $role_id;
            $arr['permission'] = $permission;

            # Check if() Record Exists |--------
            $query = "select id from permissions_map where permission = :permission && role_id = :role_id limit 1";
            $check = $role->query($query,$arr);
            if ($check) {
              # ...| TRUE Block ---| UPDATE |---
              $query = "update permissions_map set disabled = 0 where permission = :permission && role_id = :role_id limit 1";
            } else {
              # ...| FALSE Block ---| CREATE |---
              $query = "insert into permissions_map (role_id,permission) values (:role_id,:permission)";
            }
            # ---| ./IF/ELSE(Check)

            $role->query($query,$arr);
          }
          # ---| ./IF(KEY)
        }
        # ---| ./FOREACH($_POST)

        redirect('admin/roles');
      } # ---| ./IF(POST)
      # ---| ./Category MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/roles',$data);
  }
  # ---| ./Roles()\. | ---

  # -----| Profile() | -----
  public function profile($id = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())
  
    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $uid) {
      # ...| TRUE Block
      $folder = "uploads/images/";
      if (!file_exists($folder)) {
        # ...| TRUE Block
        mkdir($folder,0777,true);
        file_put_contents($folder."index.php", "<?php //Silence");
        file_put_contents("uploads/index.php", "<?php //Silence");
      }
      # ---| ./IF(Folder)

      if ($user->edit_validate($_POST,$id)) {
        # ...| TRUE Block
        $id = $uid->id;
        $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

        # ----- | CHECK IMAGES | -----
        if (!empty($_FILES['image']['name'])) {
          # ...| TRUE Block
          if ($_FILES['image']['error'] == 0) {
            # ...| TRUE Block
            if (in_array($_FILES['image']['type'], $allowed)) {
              # ...| TRUE Block | EVERYTHING'S GOOD
              $destination = $folder.time().$_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);

              resize_image($destination);
              $_POST['image'] = $destination;

              // if (file_exists($row->image)) {
              if (file_exists($uid->image)) {
                # ...| TRUE Block
                unlink($uid->image);
              }
              # ---| ./IF(imageExist)
            } else {
              # ...| FALSE Block
              $user->errors['image'] = "Sorry, this file type is not allowed!";
            }
            # ---| ./IF/ELSE(IMAGE TYPE)
          } else {
            # ...| FALSE Block
            $user->errors['image'] = "Sorry, cannot upload image!";
          }
          # ---| ./IF/ELSE(ERROR)
        }
        # ---| ./IF(IMAGE NAME)

        $user->update($id,$_POST);

        // message("Successful Update!");
        // redirect('admin/profile/'.$id);
      }
      # ---| ./IF(EDIT_VALIDATE)

      if (empty($user->errors)) {
        # ...| TRUE Block
        $arr['message'] = "Successful Update!";
      } else {
        # ...| FALSE Block
        $arr['message'] = "Please, double check inputs before Update!";
        $arr['errors'] = $user->errors;
      }
      # ---| ./IF/ELSE(Errors)

      echo json_encode($arr);
      die;
    }
    # ---| ./IF(POST)

    $data['title'] = "Profile";
    $data['errors'] = $user->errors;
    $this->view('admin/profile',$data);
  }
  # ---| ./Profile()\. | ---

  # -----| Slider_Images() | -----
  public function slider_images($id = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())
  
    $user = new \Model\User();
    $slider = new Slider();

    $user_id = Auth::getId();
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['rows'] = [];
    $rows = $slider->where(['disabled'=>0]);

    if ($rows) {
      # ...| TRUE Block
      foreach ($rows as $key => $obj) {
        $num = $obj->id;
        $data['rows'][$num] = $obj;
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    $id = $_POST['id'] ?? 0;
    $row = $slider->first(['id'=>$id]);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      # ...| TRUE Block
      $folder = "uploads/slides/";
      if (!file_exists($folder)) {
        # ...| TRUE Block
        mkdir($folder,0777,true);
        file_put_contents($folder."index.php", "<?php //Silence");
        file_put_contents("uploads/index.php", "<?php //Silence");
      }
      # ---| ./IF(Folder)

      $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

      # ----- | CHECK IMAGES | -----
      if (!empty($_FILES['image']['name'])) {
        # ...| TRUE Block
        if ($_FILES['image']['error'] == 0) {
          # ...| TRUE Block
          if (in_array($_FILES['image']['type'], $allowed)) {
            # ...| TRUE Block | EVERYTHING'S GOOD
            $destination = $folder.time().$_FILES['image']['name'];

            $_POST['image'] = $destination;
          } else {
            # ...| FALSE Block
            $slider->errors['image'] = "Sorry, this file type is not allowed!";
          }
          # ---| ./IF/ELSE(IMAGE TYPE)
        } else {
          # ...| FALSE Block
          $slider->errors['image'] = "Sorry, cannot upload image!";
        }
        # ---| ./IF/ELSE(ERROR)
      }
      # ---| ./IF(IMAGE NAME)

      if ($slider->validate($_POST,$id)) {
        # ...| TRUE Block
        if (!empty($destination)) {
          # ...| TRUE Block
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          resize_image($destination);
          if ($row && file_exists($row->image)) {
            # ...| TRUE Block
            unlink($row->image);
          }
          # ---| ./IF(imageExist)
        }
        # ---| ./IF(DESTINATION)

        # CHECK IF RECORED ALREADY EXIST |------
        if ($row) {
          # ...| TRUE Block
          unset($_POST['id']);
          $slider->update($id,$_POST);
        } else {
          # ...| FALSE Block
          $slider->insert($_POST);
        }
        # ---| ./IF/ELSE(RESULT)

        // message("Successful Update!");
        // redirect('admin/profile/'.$id);
      }
      # ---| ./IF(EDIT_VALIDATE)

      if (empty($slider->errors)) {
        # ...| TRUE Block
        $arr['message'] = "Slider details saved successfully!";
      } else {
        # ...| FALSE Block
        $arr['message'] = "Please, double check inputs before complete!";
        $arr['errors'] = $slider->errors;
      }
      # ---| ./IF/ELSE(Errors)

      echo json_encode($arr);
      die;
    }
    # ---| ./IF(POST)

    $data['title'] = "Slider Images";
    $data['errors'] = $slider->errors;

    $this->view('admin/slider-images',$data);
  }
  # ---| ./Slider_Images()\. | ---

}
# -----| ./Admin()
