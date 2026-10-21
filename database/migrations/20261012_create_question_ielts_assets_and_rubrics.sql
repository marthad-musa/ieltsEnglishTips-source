CREATE TABLE IF NOT EXISTS `question_assets` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `asset_type` varchar(30) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(1024) NOT NULL,
  `mime_type` varchar(120) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `question_id` (`question_id`),
  KEY `asset_type` (`asset_type`),
  KEY `is_primary` (`is_primary`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `question_rubrics` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `rubric_type` varchar(30) NOT NULL DEFAULT 'writing',
  `band_score` int(11) NOT NULL DEFAULT 0,
  `criteria` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `question_id` (`question_id`),
  KEY `rubric_type` (`rubric_type`),
  KEY `band_score` (`band_score`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `question`
  ADD COLUMN IF NOT EXISTS `question_type` varchar(50) NOT NULL DEFAULT 'multiple_choice' AFTER `exam_id`,
  ADD COLUMN IF NOT EXISTS `question_data` MEDIUMTEXT NULL AFTER `question_title`;
