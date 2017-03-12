#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';



\CjsConsole\ConsoleConfig::getInstance()->setEnvironments('dev');


$input = null;
$output = null;
$ConsoleObj = \CjsConsole\ConsoleApp::getInstance("cjs console", '1.0.0');
$kernel = new \ConsoleDemo\Kernel($ConsoleObj);

$scheduleObj = new \CjsConsole\Scheduling\ScheduleRunCommand($ConsoleObj->getSchedule());
$ConsoleObj->add($scheduleObj);

$status = $kernel->handle($input, $output);
$kernel->terminate($input, $status);

exit($status);

