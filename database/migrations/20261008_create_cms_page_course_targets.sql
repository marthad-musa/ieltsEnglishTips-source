-- Additive migration for attaching one CMS page to one existing course detail page.
-- Back up the database before running this migration.
-- Safe to re-run when the table already exists with this schema.

CREATE TABLE IF NOT EXISTS `cms_page_course_targets` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cms_page_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  UNIQUE KEY `cms_page_id` (`cms_page_id`),
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
