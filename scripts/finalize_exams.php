<?php

if (PHP_SAPI !== 'cli') {
  http_response_code(404);
  exit;
}

require_once __DIR__ . '/../app/bootstrap.php';

$examModelFile = APPROOT . '/models/Exam.php';
if (!is_file($examModelFile)) {
  fwrite(STDERR, "Exam model not found.\n");
  exit(2);
}
require_once $examModelFile;

if (!method_exists('Exam', 'finalizeExpiredAttempts')) {
  fwrite(STDERR, "Exam finalization is unavailable in the current app schema.\n");
  exit(2);
}

if (($argv[1] ?? '') === '--check') {
  fwrite(STDOUT, "Exam finalizer is available.\n");
  exit(0);
}

try {
  $count = (new Exam())->finalizeExpiredAttempts();
  fwrite(STDOUT, 'Finalized ' . $count . " expired exam attempt(s).\n");
} catch (\Throwable $error) {
  fwrite(STDERR, 'Exam finalization failed: ' . $error->getMessage() . "\n");
  exit(1);
}
