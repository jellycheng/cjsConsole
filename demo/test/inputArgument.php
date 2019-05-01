<?php
require_once dirname(__DIR__) . '/common.php';
//php demo/test/inputArgument.php

use \CjsConsole\Input\InputArgument;
//单个参数对象 new InputArgument('参数名', InputArgument::REQUIRED参数模式（1，2，4）, '参数描述', "默认值");
$argObj = new InputArgument('username', InputArgument::REQUIRED, '用户名');
echo $argObj->getName() . PHP_EOL; //username

var_dump($argObj->isRequired());//判断参数是否必须
echo PHP_EOL;

$argObj = new InputArgument('参数名1', 2, '参数描述,在cli中,参数名1可选', "默认值1");
echo $argObj->getName() . PHP_EOL; //参数名1
echo $argObj->getDefault() . PHP_EOL; //默认值1
echo $argObj->getDescription() . PHP_EOL; //参数描述,在cli中,参数名1可选

var_dump($argObj->isRequired());//判断参数是否必须
echo PHP_EOL;
