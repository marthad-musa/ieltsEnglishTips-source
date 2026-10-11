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
 * Course_Lecture()
 * *
 * Lectures used for each Course SECTION|CURRICULUM
 */
class Course_lecture extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "courses_lectures";
  protected $allowedColumns = [
    'unid',
    'title',
    'description',
    'file',
    'item_type',
    'duration_minutes',
    'duration_seconds',
    'content_html',
    'is_preview',
    'disabled',
  ];
  # ---| ./Properties\. | ---

  # -----| Lectures() | -----
  public function lecture($data = null) {
    # -----| Reset Errors Array() | -----
    // $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----|  |-----
    return $data;
    # ---| ./\. |---
  }
  # ---| ./Lectures()\. | ---

  public function duration_schema_ready() {
    $db = new \Database();
    $lecture_column = $db->query("SHOW COLUMNS FROM `courses_lectures` LIKE 'duration_seconds'");
    $course_column = $db->query("SHOW COLUMNS FROM `courses` LIKE 'course_timeline'");

    return !empty($lecture_column)
      && !empty($course_column)
      && stripos($course_column[0]->Type, 'decimal') === 0;
  }

  public function article_schema_ready() {
    $db = new \Database();
    $column = $db->query("SHOW COLUMNS FROM `courses_lectures` LIKE 'content_html'");
    return !empty($column);
  }

  public function store_lesson_upload($file, $item_type) {
    $rules = [
      'video' => [
        'extensions' => ['mp4' => ['video/mp4'], 'webm' => ['video/webm'], 'ogv' => ['video/ogg']],
        'max_size' => 524288000,
      ],
      'audio' => [
        'extensions' => [
          'mp3' => ['audio/mpeg'], 'm4a' => ['audio/mp4', 'audio/x-m4a'],
          'wav' => ['audio/wav', 'audio/x-wav'], 'ogg' => ['audio/ogg', 'application/ogg'],
          'oga' => ['audio/ogg', 'application/ogg'],
        ],
        'max_size' => 104857600,
      ],
      'pdf' => [
        'extensions' => ['pdf' => ['application/pdf']],
        'max_size' => 26214400,
      ],
      'reading' => [
        'extensions' => ['pdf' => ['application/pdf']],
        'max_size' => 26214400,
      ],
      'assignment' => [
        'extensions' => ['pdf' => ['application/pdf']],
        'max_size' => 26214400,
      ],
      'quiz' => [
        'extensions' => ['pdf' => ['application/pdf']],
        'max_size' => 26214400,
      ],
    ];

    if (!isset($rules[$item_type])
      || !is_array($file)
      || !isset($file['error'])
      || !is_scalar($file['error'])
      || !isset($file['tmp_name'])
      || !is_string($file['tmp_name'])
      || !isset($file['name'])
      || !is_string($file['name'])
      || !isset($file['size'])
      || !is_numeric($file['size'])) {
      return ['path' => null, 'error' => 'This lesson type does not accept an uploaded file.'];
    }
    if ((int)$file['error'] !== UPLOAD_ERR_OK) {
      return ['path' => null, 'error' => 'The lesson file upload failed. Check the file size and try again.'];
    }
    if ($file['tmp_name'] === '' || !is_uploaded_file($file['tmp_name'])) {
      return ['path' => null, 'error' => 'The uploaded lesson file is invalid.'];
    }

    $original_name = (string)($file['name'] ?? '');
    $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    $size = (int)($file['size'] ?? 0);
    if (!isset($rules[$item_type]['extensions'][$extension])
      || $size < 1
      || $size > $rules[$item_type]['max_size']
      || filesize($file['tmp_name']) !== $size) {
      return ['path' => null, 'error' => 'The lesson file format or size is not allowed for this lesson type.'];
    }

    if (!class_exists('\finfo')) {
      return ['path' => null, 'error' => 'File MIME validation is unavailable on this server.'];
    }
    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $rules[$item_type]['extensions'][$extension], true)) {
      return ['path' => null, 'error' => 'The uploaded file content does not match its file type.'];
    }
    if ($extension === 'pdf') {
      $handle = fopen($file['tmp_name'], 'rb');
      $signature = $handle ? fread($handle, 5) : false;
      if ($handle) {
        fclose($handle);
      }
      if ($signature !== '%PDF-') {
        return ['path' => null, 'error' => 'The uploaded file is not a valid PDF.'];
      }
    }

    $folder = 'uploads/courses/lessons/';
    if (!is_dir($folder) && !mkdir($folder, 0755, true) && !is_dir($folder)) {
      return ['path' => null, 'error' => 'The lesson upload folder could not be created.'];
    }
    try {
      $filename = bin2hex(random_bytes(16)) . '.' . $extension;
    } catch (\Throwable $error) {
      error_log('Could not generate a safe curriculum upload filename: ' . $error->getMessage());
      return ['path' => null, 'error' => 'A safe filename could not be generated for the lesson file.'];
    }

    $destination = $folder . $filename;
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
      return ['path' => null, 'error' => 'The lesson file could not be stored.'];
    }
    return ['path' => $destination, 'error' => null];
  }

  public function measure_video_duration_seconds($file) {
    if (empty($file) || !is_file($file) || !is_readable($file)) {
      return ['seconds' => null, 'error' => 'The video file is missing or unreadable.'];
    }

    if (!function_exists('proc_open')
      || !function_exists('proc_get_status')
      || !function_exists('proc_terminate')) {
      return ['seconds' => null, 'error' => 'PHP process execution is unavailable; install and enable FFprobe on the server.'];
    }

    $ffprobe = defined('FFPROBE_BINARY') ? (string)constant('FFPROBE_BINARY') : 'ffprobe';
    $command = escapeshellarg($ffprobe)
      . ' -v error -show_entries format=duration:stream=duration -of json '
      . escapeshellarg($file);
    $descriptors = [
      0 => ['pipe', 'r'],
      1 => ['pipe', 'w'],
      2 => ['pipe', 'w'],
    ];
    $process = @proc_open($command, $descriptors, $pipes);
    if (!is_resource($process)) {
      return ['seconds' => null, 'error' => 'FFprobe could not be started; check its server installation and permissions.'];
    }

    fclose($pipes[0]);
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);
    $output = '';
    $error_output = '';
    $exit_code = -1;
    $timed_out = false;
    $deadline = microtime(true) + 5;
    do {
      $status = proc_get_status($process);
      $output .= stream_get_contents($pipes[1]);
      $error_output .= stream_get_contents($pipes[2]);
      if (!$status['running']) {
        $exit_code = $status['exitcode'];
        break;
      }
      if (microtime(true) >= $deadline) {
        proc_terminate($process);
        $timed_out = true;
        break;
      }
      usleep(100000);
    } while (true);

    $output .= stream_get_contents($pipes[1]);
    $error_output .= stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $close_code = proc_close($process);
    if ($exit_code === -1) {
      $exit_code = $close_code;
    }

    $metadata = json_decode((string)$output, true);
    $duration = is_array($metadata) && is_array($metadata['format'] ?? null)
      ? ($metadata['format']['duration'] ?? null)
      : null;
    if (!is_numeric($duration)
      && is_array($metadata)
      && is_array($metadata['streams'] ?? null)) {
      $stream_durations = array_filter(
        array_column($metadata['streams'], 'duration'),
        'is_numeric'
      );
      if (!empty($stream_durations)) {
        $duration = max($stream_durations);
      }
    }
    if ($timed_out) {
      return ['seconds' => null, 'error' => 'FFprobe timed out while reading this video.'];
    }
    if ($exit_code !== 0 || !is_numeric($duration) || (float)$duration <= 0) {
      if (trim((string)$error_output) !== '') {
        error_log('FFprobe could not measure a curriculum video: ' . trim((string)$error_output));
      }
      return ['seconds' => null, 'error' => 'FFprobe could not read a valid video duration.'];
    }

    return ['seconds' => max(1, (int)round((float)$duration)), 'error' => null];
  }

  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Currency Block
    // if(empty($data['currency'])) {
    //   $this->errors['currency'] = "Currency is required!";
    // }
    # ---| ./IF(Currency)

    # ...| Currency-Symbol Block
    // if(empty($data['symbol'])) {
    //   $this->errors['symbol'] = "A currency symbol is required!";
    // }
    # ---| ./IF(Currency-Symbol)

    // if(empty($this->errors)) {
    //   # ...| TRUE Block
    //   return true;
    // }
    # ---| ./IF(ERRORS)

    // return false;
  }
  # ---| ./Validate()\. | ---
}
# -----| ./Course_Lecture()
