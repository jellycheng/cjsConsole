#!/usr/bin/env php
<?php
require_once __DIR__ . '/common.php';

//配置
\CjsConsole\ConsoleConfig::getInstance()->setEnvironments('dev')->setDebug(true);


$input = new \CjsConsole\input\ArgvInput();//分析cli对象,php demo/createApp.php  -V abc
//echo $input->getFirstArgument() . PHP_EOL; //获取cli 第1个参数，即命令名,如：abc

$consoleAppObj = \CjsConsole\ConsoleApp::getInstance("cjs console", '1.0.0');//app对象
//$consoleAppObj->setName("cjsConsole"); //重新设置app name

$kernel = new \ConsoleDemo\Kernel($consoleAppObj);//注入app对象

//添加命令 -- 新建工程命令:  artisan new 项目名
$consoleAppObj->add(new \CjsConsole\Command\NewCommand());

$status = $kernel->handle($input, new \CjsConsole\Output\ConsoleOutput());
$kernel->terminate($input, $status);

exit($status);

