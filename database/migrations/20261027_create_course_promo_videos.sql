-- Back up the database before applying this additive course-promotion migration.
-- New installations create this table from Database.php.
CREATE TABLE IF NOT EXISTS `course_promo_videos` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `video_slot` tinyint(1) unsigned NOT NULL,
  `video_path` varchar(1024) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  UNIQUE KEY `course_video_slot` (`course_id`, `video_slot`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
