<?php

require_once __DIR__ . '/../app/core/init.php';
require_once __DIR__ . '/../app/controllers/Exam.php';

function verify(string $name, bool $condition): void {
  if (!$condition) {
    throw new RuntimeException('FAIL: ' . $name);
  }
  echo 'PASS: ' . $name . PHP_EOL;
}

$exam = new \Model\Exam();
$teacher_exam = (object)['created_by' => 22, 'user_id' => 22];
$other_exam = (object)['created_by' => 23, 'user_id' => 23];
verify('teachers and admins may create/edit', \Model\Exam::canCreateOrEdit(2) && \Model\Exam::canCreateOrEdit(3));
verify('students may not create/edit', !\Model\Exam::canCreateOrEdit(1));
verify('only admins may approve/publish', \Model\Exam::canApprove(3) && !\Model\Exam::canApprove(2) && !\Model\Exam::canApprove(1));
verify('only students may take exams', \Model\Exam::canTakeForRole(1) && !\Model\Exam::canTakeForRole(2) && !\Model\Exam::canTakeForRole(3));
verify('teacher exam ownership is enforced', \Model\Exam::canManageExam(2, 22, $teacher_exam) && !\Model\Exam::canManageExam(2, 22, $other_exam));
verify('admins can manage any exam', \Model\Exam::canManageExam(3, 99, $other_exam));
verify('matching CSRF token accepted', \Controller\Exam::csrfMatches('session-token', 'session-token'));
verify('missing or wrong CSRF token rejected', !\Controller\Exam::csrfMatches('session-token', 'wrong') && !\Controller\Exam::csrfMatches('session-token', null) && !\Controller\Exam::csrfMatches('', ''));

$timezone = new DateTimeZone(date_default_timezone_get());
$start = new DateTimeImmutable('2030-01-01 12:00:00', $timezone);
$start_value = $start->format('Y-m-d H:i:s');
$start_epoch = $start->getTimestamp();
$scheduled_exam = (object)['exam_datetime' => $start_value, 'exam_duration' => 45];
verify('scheduled exam waits before start', $exam->getScheduleState($scheduled_exam, null, $start_epoch - 1) === 'waiting');
verify('scheduled exam opens exactly at start', $exam->getScheduleState($scheduled_exam, null, $start_epoch) === 'active');
verify('scheduled exam stays open until deadline', $exam->getScheduleState($scheduled_exam, null, $start_epoch + 2699) === 'active');
verify('scheduled exam ends exactly at deadline', $exam->getScheduleState($scheduled_exam, null, $start_epoch + 2700) === 'ended');

$retake_start = $start->modify('+2 hours');
$retake = (object)['status' => 'In Progress', 'retake_started_at' => $retake_start->format('Y-m-d H:i:s')];
$retake_epoch = $retake_start->getTimestamp();
verify('approved retake receives its own active window', $exam->getScheduleState($scheduled_exam, $retake, $retake_epoch) === 'active');
verify('retake expires after the configured duration', $exam->getScheduleState($scheduled_exam, $retake, $retake_epoch + 2700) === 'ended');
verify('only an admin-approved retake can begin', \Model\Exam_result::hasApprovedRetake((object)['status' => 'Approved', 'retake_allowed' => 1]) && !\Model\Exam_result::hasApprovedRetake((object)['status' => 'Submitted', 'retake_allowed' => 1]));
verify('submitted results are final for duplicate submissions', \Model\Exam_result::isFinalStatus('Submitted') && \Model\Exam_result::isFinalStatus('Approved') && !\Model\Exam_result::isFinalStatus('In Progress'));

verify('publish requires exactly option numbers 1 through 4', \Model\Question_option::hasExactOptionNumbers([1, 2, 3, 4]));
verify('publish rejects missing, duplicate, or invalid option numbers', !\Model\Question_option::hasExactOptionNumbers([1, 2, 3]) && !\Model\Question_option::hasExactOptionNumbers([1, 2, 2, 4]) && !\Model\Question_option::hasExactOptionNumbers([0, 2, 3, 4]));

$answers = new \Model\Exam_answer();
$mixed = $answers->scoreCounts(4, 2, 1, 1, 2.0, -0.5);
verify('correct/wrong/blank scoring uses exam marks', $mixed['score'] === 3.5 && $mixed['percentage'] === 43.75 && $mixed['unanswered_count'] === 1);
$blank = $answers->scoreCounts(4, 0, 0, 4, 2.0, -0.5);
verify('all blank answers score zero', $blank['score'] === 0.0 && $blank['percentage'] === 0.0);
$penalty = $answers->scoreCounts(4, 0, 4, 0, 1.0, -1.0);
verify('negative marking never produces negative percentage', $penalty['score'] === -4.0 && $penalty['percentage'] === 0.0);

echo 'All deterministic exam runtime checks passed.' . PHP_EOL;
