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
if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Exam()
 * *
 * The Exam Page
 */
class Exam extends Controller {
  # -----| Index() | -----
  public function index($slug = null) {
    $course = new \Model\Course();
    $course_meta = new \Model\Course_meta();

    $data['title'] = "Exam";
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>1,'published'=>1], 'desc', 10);

    # ...| READ The Course Data
    $data['row'] = $row = $course->first(['slug'=>$slug]);

    # ...| READ ALL Courses Metas
    $coursesMetas = $course_meta->where(['disabled'=>0,'course_id'=>$row->id ?? null], 'desc');
    if ($coursesMetas) {
      # ...| TRUE Block
      $data['coursesMeta'] = $coursesMetas;
    }
    # ---| ./IF(Courses Metas)

    # ...| READ ALL Courses Order by Trending Value
    $query = "select * from courses where approved = 1 and published = 1 order by trending desc limit 5";
    $data['trending'] = $course->query($query);

    if ($data['rows']) {
      # ...| TRUE Block
      $data['first_row'] = $data['rows'][0];
      unset($data['rows'][0]);

      $total_rows = count($data['rows']);
      $half_rows = round($total_rows / 2);

      /**
       * Splice()
       * *
       * a method that split an array() acourding to it's offset
       * and the data it removes will be excluded from the whole array.
       */
      $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
      $data['rows2'] = $data['rows'];
    }
    # ---| ./IF(Rows)

    $this->view('exam',$data);
  }
  # ---| ./Index()\. | ---

  public function take($exam_id = null) {
    if (!\Model\Auth::logged_in()) {
      message('Please log in to access the exam.');
      redirect('login');
      return;
    }

    $exam_id = (int)$exam_id;
    if ($exam_id <= 0) {
      message('Exam not found.');
      redirect('admin/exams');
      return;
    }

    $exam = new \Model\Exam();
    $question = new \Model\Question();
    $enroll = new \Model\Exam_enroll();
    $user_id = \Model\Auth::getId();

    $exam_row = $exam->first(['id' => $exam_id]);
    if (!$exam_row) {
      message('Exam not found.');
      redirect('admin/exams');
      return;
    }

    if (!$enroll->exists($user_id, $exam_id)) {
      message('You must be enrolled in this exam before you can take it.');
      redirect('admin/exams');
      return;
    }

    $questions = $question->where(['exam_id' => $exam_id]);
    $data = [
      'title' => 'Student Exam',
      'exam' => $exam_row,
      'questions' => is_array($questions) ? $questions : [],
      'question_model' => $question,
      'uid' => (new \Model\User())->first(['id' => $user_id]),
    ];

    $this->view('exam_take', $data);
  }

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Exam Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Exam()
