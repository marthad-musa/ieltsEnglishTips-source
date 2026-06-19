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
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Exam()
 * *
 * The Exams MODEL
 */
class Exam extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "exam";

  protected $afterSelect = [
    'get_user',
    'get_course',
  ];

  protected $beforeUpdate = [];
  // protected $afterDelete = [];

  protected $allowedColumns = [
    'id',
    'user_id',
    'exam_title',
    'exam_datetime',
    'exam_duration',
    'total_question',
    'right_answer_mark',
    'wrong_answer_mark',
    'exam_created_on',
    'exam_status',
    'csrf_code',
    'course_id',
    'disabled',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| TITLE Block
    if(empty($data['exam_title'])) {
      $this->errors['exam_title'] = "Exam title is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['exam_title']))) {
      $this->errors['exam_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    # ...| Course_ID Block
    if(empty($data['course_id'])) {
      $this->errors['course_id'] = "Course is required!";
    }
    # ---| ./IF(Category_ID)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. |---


  # -----| EDIT_Validate() |-----
  public function edit_validate($data,$id = null) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler Depending on TAB-Names |-----
    # ...| TITLE Block
    if(empty($data['exam_title'])) {
      $this->errors['exam_title'] = "Exam title is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['title']))) {
      $this->errors['exam_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    # ...| Course ID Block
    if(empty($data['course_id'])) {
      $this->errors['course_id'] = "Course is required!";
    }
    # ---| ./IF(Course ID)

    # ...| Exam DateTime Block
    if(empty($data['exam_datetime'])) {
      $this->errors['exam_datetime'] = "Set Date &amp; Time for exam!";
    }
    # ---| ./IF(Exam DateTime)

    # ...| Exam Duration Block
    if(empty($data['exam_duration'])) {
      $this->errors['exam_duration'] = "Set Duration Time for exam!";
    }
    # ---| ./IF(Exam Duration)

    # ...| Exam Total Questions Block
    if(empty($data['total_question'])) {
      $this->errors['total_question'] = "Set total number of question for exam!";
    }
    # ---| ./IF(Exam Total Questions)

    # ...| Exam Right Answer Mark Block
    if(empty($data['right_answer_mark'])) {
      $this->errors['right_answer_mark'] = "Set right answer mark for exam!";
    }
    # ---| ./IF(Exam Right Answer Mark)

    # ...| Exam Wrong Answer Mark Block
    if(empty($data['wrong_answer_mark'])) {
      $this->errors['wrong_answer_mark'] = "Set wrong answer mark for exam!";
    }
    # ---| ./IF(Exam Wrong Answer Mark)

    # ...| Exam Status Block
    if(empty($data['exam_status'])) {
      $this->errors['exam_status'] = "Set status for exam!";
    }
    # ---| ./IF(Exam Status)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./EDIT_Validate()\. |---


  # -----| AfterSELECT Functions |-----
  protected function get_user($rows) {
    $db = new \Database();
    if (!empty($rows[0]->user_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select firstname, lastname, role, image from users where id = :id limit 1";
        $user = $db->query($query,['id'=>$row->user_id]);
        if (!empty($user)) {
          # ...| TRUE Block
          $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
          $rows[$key]->user_row = $user[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_USER() |---


  protected function get_course($rows) {
    $db = new \Database();
    if (!empty($rows[0]->course_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from courses where id = :id limit 1";
        $cour = $db->query($query,['id'=>$row->course_id]);
        if (!empty($cour)) {
          # ...| TRUE Block
          $rows[$key]->course_row = $cour[0];
        }
        # ---| ./IF(Category)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_CATEGORY() |---
  # ---| ./AfterSELECT Functions\. |---


  /* -----| Online Methods | ----- */
  # Exam Not Started  ---------------
	public function exam_not_started(int $id):bool {
    $db = new \Database();

		$current_datetime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));

		$exam_datetime = '';

		$query = "SELECT exam_datetime FROM exam WHERE id = :id";
    $date_time = $db->query($query,['id'=>$id]);

		// $result = $this->query_result();

		foreach($date_time as $row) {
			$exam_datetime = strtotime($row['exam_datetime']);
		}
    # ---| ./FOREACH(Date Time)

		if($exam_datetime > $current_datetime) {
			return true;
		}
    # ---| ./IF(Exam DateTime)

		return false;
	}
  # ------------|  ./Exam Not Started


  # Get Exam Question Limit  ---------------
	public function get_exam_question_limit(int $id) :mixed {
    $db = new \Database();

    $query = "SELECT total_question FROM exam WHERE id = :id";
    $questions = $db->query($query,['id'=>$id]);

		foreach($questions as $question) {
			return $question->total_question;
		}
    # ---| ./FOREACH()
	}
  # ------------|  ./Get Exam Question Limit


  # Get Total Question  ---------------
	public function Get_total_question(int $id) :mixed {
    $db = new \Database();

		$query = "SELECT question_id FROM questions WHERE exam_id = :exam_id";
    $total_questions = $db->query($query,['exam_id'=>$id]);

		return rowCount($total_questions);
	}
  # ------------|  ./Get Total Question


  # Allow Question Add  ---------------
	public function allowed_question_add (int $id) :bool {
		$exam_question_limit = $this->Get_exam_question_limit($id);

		$exam_total_question = $this->Get_total_question($id);

		if ($exam_total_question >= $exam_question_limit) {
      # ...| TRUE Block
			return false;
		}
    # ---| ./IF(Total > Limit)

    return true;
	}
  # ------------|  ./Allow Question Add


  # Last ID Question  ---------------
	// public function last_id_question() {
	// 	$this->statement = $this->connect->prepare($this->query);
	// 	$this->statement->execute($this->data);
	// 	return $this->connect->lastInsertId();
	// }
  # ------------|  ./Last ID Question


  # Get Exam ID  ---------------
	public function Get_id(int $csrf_code) :mixed {
    $db = new \Database();

		$query = "SELECT id FROM exam WHERE csrf_code = :csrf_code";
		$exams = $db->query($query,['csrf_code'=>$csrf_code]);

		foreach($exams as $row) {
			return $row['id'];
		}
    # ---| ./FOREACH(Exam ID)
	}
  # ------------|  ./Get Exam ID


  # Fill Exam List  ---------------
	public function Fill_exam_list() {
    $db = new \Database();

		$query = "SELECT id, exam_title FROM exam WHERE exam_status = 'Created' OR exam_status = 'Pending' ORDER BY exam_title ASC";
    $lists = $db->query($query);
		$output = '';
		foreach($lists as $row)
		{
			$output .= '<option value="'.$row["id"].'">'.$row["exam_title"].'</option>';
		}
		return $output;
	}
  # ------------|  ./Fill Exam List


  #   ---------------
  # ------------|  ./


  #   ---------------
  # ------------|  ./

  # ---| ./Online Methods\. | ---
}
# -----| ./Course()
