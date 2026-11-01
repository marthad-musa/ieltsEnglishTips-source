-- Back up the database before applying this additive course-promotion migration.
-- Apply after the course_promo_videos table has been created.
SET @promo_video_title_exists = (
  SELECT COUNT(*)
  FROM information_schema.columns
  WHERE table_schema = DATABASE()
    AND table_name = 'course_promo_videos'
    AND column_name = 'video_title'
);

SET @promo_video_title_sql = IF(
  @promo_video_title_exists = 0,
  'ALTER TABLE `course_promo_videos` ADD COLUMN `video_title` varchar(255) DEFAULT NULL AFTER `video_path`',
  'SELECT 1'
);

PREPARE promo_video_title_statement FROM @promo_video_title_sql;
EXECUTE promo_video_title_statement;
DEALLOCATE PREPARE promo_video_title_statement;
