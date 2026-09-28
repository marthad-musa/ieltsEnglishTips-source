ALTER TABLE `exam_results`
  ADD COLUMN `retake_started_at` datetime DEFAULT NULL AFTER `retake_allowed`;
