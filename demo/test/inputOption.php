<?php
require_once dirname(__DIR__) . '/common.php';


use \CjsConsole\Input\InputOption;

$ioObj = new InputOption('--help', '-h', InputOption::VALUE_NONE, 'Display this help message');

echo 'name: ' . $ioObj->getName() . PHP_EOL;
echo 'shortcut: ' . $ioObj->getShortcut() . PHP_EOL;
echo 'default: ' . $ioObj->getDefault() . PHP_EOL;
echo 'description: ' . $ioObj->getDescription() . PHP_EOL;


$ioObj = new InputOption('--quiet','-q', InputOption::VALUE_NONE, 'Do not output any message对选项的描述');
echo 'name: ' . $ioObj->getName() . PHP_EOL;
echo 'shortcut: ' . $ioObj->getShortcut() . PHP_EOL;
echo 'default: ' . $ioObj->getDefault() . PHP_EOL;
echo 'description: ' . $ioObj->getDescription() . PHP_EOL;
