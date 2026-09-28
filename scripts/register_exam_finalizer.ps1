$ErrorActionPreference = 'Stop'

$php = Join-Path $env:SystemDrive 'xampp\php\php.exe'
$finalizer = Join-Path $PSScriptRoot 'finalize_exams.php'
$projectRoot = Split-Path -Parent $PSScriptRoot
$taskName = 'IELTS Exam Finalizer'

if (!(Test-Path $php)) {
  throw "PHP CLI not found at $php"
}
if (!(Test-Path $finalizer)) {
  throw "Finalizer script not found at $finalizer"
}

$action = New-ScheduledTaskAction -Execute $php -Argument ('"{0}"' -f $finalizer) -WorkingDirectory $projectRoot
$trigger = New-ScheduledTaskTrigger -Once -At (Get-Date).AddMinutes(1) -RepetitionInterval (New-TimeSpan -Minutes 1) -RepetitionDuration (New-TimeSpan -Days 365)
Register-ScheduledTask -TaskName $taskName -Action $action -Trigger $trigger -Description 'Finalize expired IELTS exam attempts every minute.' -Force | Out-Null
Write-Output "Registered '$taskName' to run every minute for one year."
