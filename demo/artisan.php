#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';



//Console config todo


$input = null;
$output = null;
$ConsoleObj = \CjsConsole\ConsoleApp::getInstance("cjs console", '1.0.0');
$kernel = new \ConsoleDemo\Kernel($ConsoleObj);

$status = $kernel->handle($input, $output);
$kernel->terminate($input, $status);

exit($status);

