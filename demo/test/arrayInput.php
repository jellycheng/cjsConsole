<?php
require_once dirname(__DIR__) . '/common.php';

use \CjsConsole\Input\ArrayInput;

$input = new ArrayInput(array('hello' => 'foo', '--bar' => 'foobar', 'xyz'=>'hi123'));

echo $input->getFirstArgument() . PHP_EOL; //获取第一个参数值 foo

echo $input->getParameterOption("xyz") . PHP_EOL; //获取xyz参数值： hi123
echo $input->getParameterOption("--bar") . PHP_EOL; //获取--bar选项值： foobar

echo $input . PHP_EOL;//foo --bar=foobar hi123
//等价 echo $input->__toString() . PHP_EOL;

