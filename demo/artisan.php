#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';



//Console config todo


$input = '';
$output = '';
$ConsoleObj = \CjsConsole\ConsoleApp::getInstance();
$kernel = new \ConsoleDemo\Kernel($ConsoleObj);

$status = $kernel->handle($input, $output);
$kernel->terminate($input, $status);

exit($status);

