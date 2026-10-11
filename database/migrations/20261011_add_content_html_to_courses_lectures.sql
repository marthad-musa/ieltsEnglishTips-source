-- Back up the database before applying this additive curriculum migration.
-- Run once on existing installations; new installations receive this column from Database.php.
ALTER TABLE `courses_lectures`
  ADD COLUMN `content_html` MEDIUMTEXT DEFAULT NULL AFTER `duration_seconds`;
