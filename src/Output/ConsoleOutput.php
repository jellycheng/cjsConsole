<?php
namespace CjsConsole\Output;

class ConsoleOutput {



    public function __call($name, $arguments)
    {
        echo sprintf("ConsoleOutput, name:%s, arguments:%s", $name, is_array($arguments)?var_export($arguments, true):$arguments) . PHP_EOL;
    }

}