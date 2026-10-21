ALTER TABLE `question`
  ADD COLUMN `question_type` varchar(50) NOT NULL DEFAULT 'multiple_choice' AFTER `exam_id`,
  ADD COLUMN `question_data` MEDIUMTEXT NULL AFTER `question_title`;

-- Keep compatibility with older questions by defaulting them to the original multiple-choice format.
UPDATE `question`
SET `question_type` = 'multiple_choice'
WHERE `question_type` IS NULL OR `question_type` = '';
