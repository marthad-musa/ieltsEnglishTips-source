$ErrorActionPreference = 'Stop'
$projectRoot = Split-Path -Parent $PSScriptRoot
$php = 'C:\xampp\php\php.exe'
$script = Join-Path $PSScriptRoot 'finalize_exams.php'
$taskName = 'IELTS English Tips Exam Finalizer'

if (-not (Test-Path -LiteralPath $php)) {
  throw "PHP CLI not found at $php. Update this script with the installed PHP path."
}
if (-not (Test-Path -LiteralPath $script)) {
  throw "Finalizer script not found at $script."
}

& $php $script --check
if ($LASTEXITCODE -ne 0) {
  throw 'The current application does not provide exam finalization; scheduled task was not registered.'
}

$action = New-ScheduledTaskAction -Execute $php -Argument "`"$script`"" -WorkingDirectory $projectRoot
$trigger = New-ScheduledTaskTrigger -Once -At (Get-Date).AddMinutes(1) -RepetitionInterval (New-TimeSpan -Minutes 1) -RepetitionDuration (New-TimeSpan -Days 3650)
$settings = New-ScheduledTaskSettingsSet -StartWhenAvailable -MultipleInstances IgnoreNew
Register-ScheduledTask -TaskName $taskName -Action $action -Trigger $trigger -Settings $settings -Description 'Finalize expired exam attempts and mark published exams complete.' -Force
Write-Output "Registered scheduled task: $taskName"
