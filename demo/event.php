<?php
require_once __DIR__ . '/common.php';

$command = PHP_BINARY.' test.php ';
$event = new \CjsConsole\Scheduling\Event($command);
$event = $event->hourly(); //设置每小时执行一次，返回Event对象


