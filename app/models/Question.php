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
 * Question()
 * *
 * The Questions MODEL
 */
class Question extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "question";

  protected $afterSelect = [
    'get_exam_id',
    // 'get_last_id',
    'get_question_option',
  ];

  protected $beforeUpdate = [];
  // protected $afterDelete = [];

  protected $allowedColumns = [
    'id',
    'exam_id',
    'question_title',
    'answer_option',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| TITLE Block
    if(empty($data['question_title'])) {
      $this->errors['question_title'] = "Question title is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['question_title']))) {
      $this->errors['question_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    # ...| Course_ID Block
    if(empty($data['exam_id'])) {
      $this->errors['exam_id'] = "Exam is required!";
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
  protected function get_exam_id($rows) {
    $db = new \Database();
    if (!empty($rows[0]->id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from exam where id = :id limit 1";
        $exam = $db->query($query,['id'=>$row->exam_id]);
        if (!empty($exam)) {
          # ...| TRUE Block
          $rows[$key]->exam_row = $exam[0];
        }
        # ---| ./IF(EXAM)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_EXAM() |---


  public function get_last_id($row) {
    $db = new \Database();
    // if (!empty($rows[0]->id)) {
    //   # ...| TRUE Block
      // foreach ($rows as $key => $row) {
        $query = "select id from question where exam_id = :exam_id order by exam_id asc";
        $last_id = $db->query($query,['exam_id'=>$row]);
        if (!empty($last_id)) {
          # ...| TRUE Block
          $last_id = array_reverse($last_id);
          return $last_id[0];
        }
        # ---| ./IF(EXAM)
      // }
      // # ---| ./FOREACH(ROWS)
    // }
    // # ---| ./IF(ROWS)

    // return $rows;

    // $query = "";
  } # ---| ./Get_last_id() |---


  protected function get_question_option($rows) {
    $db = new \Database();
    if (!empty($rows[0]->id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from question_option where question_id = :question_id limit 1";
        // $question_option = $db->query($query,['question_id'=>$row->question_id]);
        if (!empty($question_option)) {
          # ...| TRUE Block
          $rows[$key]->question_option_row = $question_option[0];
        }
        # ---| ./IF(EXAM)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_QUESTION_OPTION() |---
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


  # Get Total Question  ---------------
	public function get_total_question(int $id) :mixed {
    $db = new \Database();

		$query = "SELECT question_id FROM question WHERE exam_id = :exam_id";
    $total_questions = $db->query($query,['exam_id'=>$id]);

		return rowCount($total_questions);
	}
  # ------------|  ./Get Total Question


  # Allow Question Add  ---------------
	public function allowed_question_add (int $id) :bool {
		$exam_question_limit = $this->get_exam_question_limit($id);

		$exam_total_question = $this->get_total_question($id);

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
	public function get_id(int $csrf_code) :mixed {
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
	public function fill_exam_list() {
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
