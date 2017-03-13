#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';

\CjsConsole\ConsoleConfig::getInstance()->setEnvironments('dev')->setDebug(true);


$input = new \CjsConsole\input\ArgvInput();
$ConsoleObj = \CjsConsole\ConsoleApp::getInstance("cjs console", '1.0.0');
$kernel = new \ConsoleDemo\Kernel($ConsoleObj);

$scheduleObj = new \CjsConsole\Scheduling\ScheduleRunCommand($ConsoleObj->getSchedule());
$ConsoleObj->add($scheduleObj);

$status = $kernel->handle($input, new \CjsConsole\Output\ConsoleOutput());
$kernel->terminate($input, $status);

exit($status);

