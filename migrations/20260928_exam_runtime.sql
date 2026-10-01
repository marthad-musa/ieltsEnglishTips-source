-- LEGACY SCHEMA ONLY: this migration targets exam/exam_enroll/exam_answers tables
-- that are not part of the current database.sql application schema. Do not run
-- against the current app database without first restoring that legacy schema.
-- Apply once to a matching legacy installation after backing up the database.
-- Resolve duplicate rows before adding either answer/option/enrollment unique key.
ALTER TABLE `exam`
  MODIFY `exam_duration` SMALLINT UNSIGNED DEFAULT NULL,
  MODIFY `right_answer_mark` DECIMAL(8,2) DEFAULT NULL,
  MODIFY `wrong_answer_mark` DECIMAL(8,2) DEFAULT NULL;

ALTER TABLE `exam_enroll`
  CHANGE `exam_enroll_id` `id` INT(11) NOT NULL AUTO_INCREMENT,
  MODIFY `attendance_status` ENUM('Absent','Present') NOT NULL DEFAULT 'Absent',
  ADD COLUMN `disabled` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN `created_at` DATETIME DEFAULT NULL,
  ADD UNIQUE KEY `unique_exam_user` (`exam_id`, `user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disabled` (`disabled`);

ALTER TABLE `exam_answers`
  ADD UNIQUE KEY `unique_exam_user_question` (`exam_id`, `user_id`, `question_id`);

ALTER TABLE `exam_join_requests`
  ADD COLUMN `requested_by` INT(11) DEFAULT NULL;

ALTER TABLE `exam_results`
  MODIFY `score` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  ADD COLUMN `retake_started_at` DATETIME DEFAULT NULL AFTER `retake_allowed`,
  ADD COLUMN `correct_count` INT(11) NOT NULL DEFAULT 0,
  ADD COLUMN `wrong_count` INT(11) NOT NULL DEFAULT 0,
  ADD COLUMN `unanswered_count` INT(11) NOT NULL DEFAULT 0;

ALTER TABLE `question_option`
  ADD UNIQUE KEY `unique_question_option_number` (`question_id`, `option_number`);
