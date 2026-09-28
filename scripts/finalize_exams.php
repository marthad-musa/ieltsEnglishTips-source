<?php

if (PHP_SAPI !== 'cli') {
  http_response_code(404);
  exit;
}

require_once __DIR__ . '/../app/core/init.php';

try {
  $count = (new \Model\Exam_result())->finalizeExpiredAttempts();
  fwrite(STDOUT, 'Finalized ' . $count . " expired exam attempt(s).\n");
} catch (\Throwable $error) {
  fwrite(STDERR, 'Exam finalization failed: ' . $error->getMessage() . "\n");
  exit(1);
}
