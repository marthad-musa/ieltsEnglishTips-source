<?php

namespace Model;

if (!defined("ROOT")) die ("direct script access denied!");

class Course_promo_video extends Model {
  protected $table = "course_promo_videos";
  protected $afterSelect = [];
  protected $allowedColumns = [
    'id',
    'course_id',
    'video_slot',
    'video_path',
    'video_title',
    'caption',
  ];

  public function schemaReady(): bool {
    try {
      $tables = $this->query(
        "SELECT COUNT(*) AS table_count
         FROM information_schema.tables
         WHERE table_schema = DATABASE()
           AND table_name = 'course_promo_videos'"
      );
      if (empty($tables) || (int)$tables[0]->table_count !== 1) {
        return false;
      }

      $columns = $this->query(
        "SELECT COUNT(*) AS column_count
           FROM information_schema.columns
           WHERE table_schema = DATABASE()
             AND table_name = 'course_promo_videos'
             AND column_name = 'video_title'"
      );
      return !empty($columns) && (int)$columns[0]->column_count === 1;
    } catch (\PDOException $error) {
      error_log('Course promotional video schema check failed: ' . $error->getMessage());
      return false;
    }
  }

  public function forCourse(int $course_id): array {
    $rows = $this->query(
      'SELECT video_slot, video_path, video_title, caption FROM course_promo_videos WHERE course_id = :course_id ORDER BY video_slot ASC',
      ['course_id' => $course_id]
    );
    return is_array($rows) ? $rows : [];
  }

  public function saveDetails(int $course_id, int $slot, string $video_title, string $caption): void {
    $this->query(
      'INSERT INTO course_promo_videos (course_id, video_slot, video_title, caption)
       VALUES (:course_id, :video_slot, :video_title, :caption)
       ON DUPLICATE KEY UPDATE video_title = VALUES(video_title), caption = VALUES(caption)',
      [
        'course_id' => $course_id,
        'video_slot' => $slot,
        'video_title' => $video_title,
        'caption' => $caption,
      ]
    );
  }

  public function saveCaption(int $course_id, int $slot, string $caption): void {
    $this->query(
      'INSERT INTO course_promo_videos (course_id, video_slot, caption)
       VALUES (:course_id, :video_slot, :caption)
       ON DUPLICATE KEY UPDATE caption = VALUES(caption)',
      ['course_id' => $course_id, 'video_slot' => $slot, 'caption' => $caption]
    );
  }

  public function saveVideo(int $course_id, int $slot, string $video_path): void {
    $this->query(
      'INSERT INTO course_promo_videos (course_id, video_slot, video_path)
       VALUES (:course_id, :video_slot, :video_path)
       ON DUPLICATE KEY UPDATE video_path = VALUES(video_path)',
      ['course_id' => $course_id, 'video_slot' => $slot, 'video_path' => $video_path]
    );
  }
}
