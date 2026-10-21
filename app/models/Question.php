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
    'question_type',
    'question_title',
    'question_data',
    'answer_option',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function normalize_question_type($type) {
    $allowed = [
      'multiple_choice',
      'true_false',
      'yes_no',
      'short_answer',
      'sentence_completion',
      'summary_completion',
      'matching',
      'map_picture',
      'diagram',
      'audio_completion',
      'writing_prompt',
      'speaking_prompt',
    ];

    $normalized = strtolower((string)($type ?? 'multiple_choice'));
    return in_array($normalized, $allowed, true) ? $normalized : 'multiple_choice';
  }

  public function to_question_data(array $data): array {
    $questionType = $this->normalize_question_type($data['question_type'] ?? 'multiple_choice');
    $payload = [
      'question_type' => $questionType,
      'answer_text' => trim((string)($data['answer_text'] ?? '')),
      'task_prompt' => trim((string)($data['task_prompt'] ?? '')),
      'rubric_text' => trim((string)($data['rubric_text'] ?? '')),
      'word_count_min' => trim((string)($data['word_count_min'] ?? '')),
      'word_count_max' => trim((string)($data['word_count_max'] ?? '')),
      'prompt_type' => trim((string)($data['prompt_type'] ?? '')),
      'extra_notes' => trim((string)($data['extra_notes'] ?? '')),
      'audio_caption' => trim((string)($data['audio_caption'] ?? '')),
      'image_caption' => trim((string)($data['image_caption'] ?? '')),
      'diagram_caption' => trim((string)($data['diagram_caption'] ?? '')),
      'band_score' => trim((string)($data['band_score'] ?? '')),
      'rubric_type' => trim((string)($data['rubric_type'] ?? '')),
    ];

    foreach (range(1, 4) as $option_number) {
      $field = 'option_number_' . $option_number;
      if (isset($data[$field]) && is_string($data[$field])) {
        $payload['options'][$option_number] = trim($data[$field]);
      }
    }

    if (isset($data['answer_option']) && $data['answer_option'] !== '') {
      $payload['answer_option'] = (string)$data['answer_option'];
    }

    return $payload;
  }

  public function decode_question_data($row): array {
    if (empty($row)) {
      return [];
    }

    $payload = $row->question_data ?? null;
    if (is_array($payload)) {
      return $payload;
    }

    if (!is_string($payload) || trim($payload) === '') {
      return [];
    }

    $decoded = json_decode($payload, true);
    return is_array($decoded) ? $decoded : [];
  }

  public function get_question_assets($question_id): array {
    $db = new \Database();
    $query = "select * from question_assets where question_id = :question_id order by is_primary desc, id asc";
    $rows = $db->query($query, ['question_id' => (int)$question_id]);
    return is_array($rows) ? $rows : [];
  }

  public function get_question_rubrics($question_id): array {
    $db = new \Database();
    $query = "select * from question_rubrics where question_id = :question_id order by id asc";
    $rows = $db->query($query, ['question_id' => (int)$question_id]);
    return is_array($rows) ? $rows : [];
  }

  public function render_question_html($row): string {
    $payload = $this->decode_question_data($row);
    $question_type = $this->normalize_question_type($payload['question_type'] ?? ($row->question_type ?? 'multiple_choice'));
    $html = '<div class="question-render">';

    if ($question_type === 'audio_completion') {
      $audioAssets = $this->get_question_assets($row->id);
      $audioPath = '';
      foreach ($audioAssets as $asset) {
        if (($asset['asset_type'] ?? '') === 'audio') {
          $audioPath = $asset['file_path'];
          break;
        }
      }
      $html .= '<div class="mb-3"><strong>Listening audio</strong></div>';
      if ($audioPath !== '') {
        $html .= '<audio controls preload="metadata" style="width:100%"><source src="/' . ltrim($audioPath, '/') . '" type="audio/mpeg"></audio>';
      }
      $html .= '<div class="mt-2"><strong>Model answer</strong><div class="border rounded p-2">' . htmlspecialchars($payload['answer_text'] ?? '', ENT_QUOTES, 'UTF-8') . '</div></div>';
    } elseif ($question_type === 'map_picture' || $question_type === 'diagram') {
      $mediaAssets = $this->get_question_assets($row->id);
      $imagePath = '';
      foreach ($mediaAssets as $asset) {
        if (in_array($asset['asset_type'] ?? '', ['image', 'diagram'], true)) {
          $imagePath = $asset['file_path'];
          break;
        }
      }
      if ($imagePath !== '') {
        $html .= '<div class="mb-3"><img src="/' . ltrim($imagePath, '/') . '" class="img-fluid border rounded" alt="Question image"></div>';
      }
      $html .= '<div class="mt-2"><strong>Answer key</strong><div class="border rounded p-2">' . htmlspecialchars($payload['answer_text'] ?? '', ENT_QUOTES, 'UTF-8') . '</div></div>';
    } elseif ($question_type === 'writing_prompt' || $question_type === 'speaking_prompt') {
      $html .= '<div class="mb-2"><strong>Prompt</strong><div class="border rounded p-2">' . nl2br(htmlspecialchars($payload['task_prompt'] ?? '', ENT_QUOTES, 'UTF-8')) . '</div></div>';
      $html .= '<div class="mb-2"><strong>Rubric</strong><div class="border rounded p-2">' . nl2br(htmlspecialchars($payload['rubric_text'] ?? '', ENT_QUOTES, 'UTF-8')) . '</div></div>';
      $rubrics = $this->get_question_rubrics($row->id);
      if (!empty($rubrics)) {
        foreach ($rubrics as $rubric) {
          $html .= '<div class="small text-muted">Band ' . (int)($rubric['band_score'] ?? 0) . ': ' . htmlspecialchars($rubric['criteria'] ?? '', ENT_QUOTES, 'UTF-8') . '</div>';
        }
      }
    } else {
      $html .= '<div class="fw-semibold mb-2">' . htmlspecialchars($row->question_title ?? '', ENT_QUOTES, 'UTF-8') . '</div>';
      $options = [];
      $db = new \Database();
      $optionRows = $db->query('select * from question_option where question_id = :question_id order by option_number asc', ['question_id' => (int)$row->id]);
      if (is_array($optionRows)) {
        foreach ($optionRows as $option) {
          $options[] = '<div class="border rounded p-2 mb-2">Option ' . (int)($option['option_number'] ?? 0) . ': ' . htmlspecialchars($option['option_title'] ?? '', ENT_QUOTES, 'UTF-8') . '</div>';
        }
      }
      $html .= implode('', $options);
      $html .= '<div class="mt-2"><strong>Correct answer</strong><div class="border rounded p-2">' . htmlspecialchars($payload['answer_text'] ?? ($row->answer_option ?? ''), ENT_QUOTES, 'UTF-8') . '</div></div>';
    }

    $html .= '</div>';
    return $html;
  }

  public function save_uploaded_question_asset(int $question_id, string $asset_type, array $file, string $caption = ''): array {
    if (!isset($file['name']) || $file['name'] === '') {
      throw new \InvalidArgumentException('No file was supplied.');
    }

    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'] ?? '')) {
      throw new \InvalidArgumentException('The uploaded file is invalid.');
    }

    $asset_type = strtolower($asset_type);
    $allowed_types = [
      'audio' => ['mp3', 'wav', 'm4a', 'ogg', 'aac'],
      'image' => ['jpg', 'jpeg', 'png', 'webp'],
      'diagram' => ['jpg', 'jpeg', 'png', 'webp', 'svg'],
    ];

    if (!isset($allowed_types[$asset_type])) {
      throw new \InvalidArgumentException('Unsupported asset type.');
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed_types[$asset_type], true)) {
      throw new \InvalidArgumentException('This file type is not allowed for that asset.');
    }

    $max_size = $asset_type === 'audio' ? 15 * 1024 * 1024 : 8 * 1024 * 1024;
    if (($file['size'] ?? 0) > $max_size) {
      throw new \InvalidArgumentException('The uploaded file exceeds the allowed size limit.');
    }

    $dir = 'uploads/questions/' . $asset_type . '/';
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
      throw new \RuntimeException('The upload folder could not be created.');
    }

    $safe_name = preg_replace('/[^a-zA-Z0-9._-]+/', '_', basename($file['name']));
    $target = $dir . time() . '_' . bin2hex(random_bytes(6)) . '_' . $safe_name;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
      throw new \RuntimeException('The file could not be saved to disk.');
    }

    $mime_type = function_exists('mime_content_type') ? mime_content_type($target) : null;

    $asset = new \Model\Question_asset();
    $asset->insert([
      'question_id' => (int)$question_id,
      'asset_type' => $asset_type,
      'file_name' => $safe_name,
      'file_path' => $target,
      'mime_type' => $mime_type,
      'caption' => trim($caption),
      'is_primary' => 1,
    ]);

    return [
      'file_path' => $target,
      'file_name' => $safe_name,
      'mime_type' => $mime_type,
    ];
  }

  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    $question_type = $this->normalize_question_type($data['question_type'] ?? 'multiple_choice');

    # -----| Error Handler |-----
    # ...| TITLE Block
    if (!isset($data['question_title']) || !is_string($data['question_title']) || trim($data['question_title']) === '') {
      $this->errors['question_title'] = "Question title is required!";
    } elseif (!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['question_title']))) {
      $this->errors['question_title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    # ...| Course_ID Block
    if(empty($data['exam_id'])) {
      $this->errors['exam_id'] = "Exam is required!";
    }
    # ---| ./IF(Category_ID)

    if (in_array($question_type, ['multiple_choice', 'true_false', 'yes_no'], true)) {
      foreach (range(1, 4) as $option_number) {
        $field = 'option_number_' . $option_number;
        if (!isset($data[$field]) || !is_string($data[$field]) || trim($data[$field]) === '') {
          $this->errors[$field] = "All answer options are required!";
        }
      }

      $allowedAnswers = ['1', '2', '3', '4'];
      if ($question_type === 'true_false' || $question_type === 'yes_no') {
        $allowedAnswers = ['1', '2', '3'];
      }

      if (!in_array((string)($data['answer_option'] ?? ''), $allowedAnswers, true)) {
        $this->errors['answer_option'] = "Select the correct answer option!";
      }
    }

    if (in_array($question_type, ['short_answer', 'sentence_completion', 'summary_completion', 'matching', 'diagram', 'audio_completion', 'map_picture', 'writing_prompt', 'speaking_prompt'], true)) {
      $answerText = trim((string)($data['answer_text'] ?? ''));
      if ($answerText === '') {
        $this->errors['answer_text'] = "Add the expected answer or answer key for this question type.";
      }
    }

    if (in_array($question_type, ['writing_prompt', 'speaking_prompt'], true)) {
      $taskPrompt = trim((string)($data['task_prompt'] ?? ''));
      if ($taskPrompt === '') {
        $this->errors['task_prompt'] = "Add the prompt or task instructions for this writing/speaking question.";
      }
      $rubricText = trim((string)($data['rubric_text'] ?? ''));
      if ($rubricText === '') {
        $this->errors['rubric_text'] = "Add the rubric or marking guide for this writing/speaking question.";
      }
    }

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

		$query = "SELECT COUNT(*) AS total FROM question WHERE exam_id = :exam_id";
    $total_questions = $db->query($query,['exam_id'=>$id]);

		return (int)($total_questions[0]->total ?? 0);
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
