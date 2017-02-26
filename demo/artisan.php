#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';



//Console config todo


$ConsoleObj = \CjsConsole\ConsoleApp::getInstance();


$status = 0;
$ConsoleObj->terminate($input, $status);

exit($status);

