<?php
namespace CjsConsole;

use CjsConsole\Scheduling\Schedule;
class ConsoleApp {

    protected static $instance = null;
    protected $commands = [];
    protected $commandConfig = [];

    private $autoExit = true;
    private $catchExceptions = true;

    public static function getInstance() {
        if(static::$instance) {
            return static::$instance;
        }
        static::$instance = new static();
        return static::$instance;
    }

    protected function __construct()
    {

        $this->init();
    }


    protected function init() {


    }

    public function setCommandConfig($command) {
        $this->commandConfig = array_merge($this->commandConfig, (array)$command);
        return $this;
    }

    public function setCommands($command) {

        $this->commands[$command->getName()] = $command;
        foreach ($command->getAliases() as $alias) {
            $this->commands[$alias] = $command;
        }
        return $command;
    }


    public function run($input, $output) {
        echo '实例化所有command类' . PHP_EOL; //todo

        return 0;
        try {
            $exitCode = $this->doRun($input, $output);
        } catch (\Exception $e) {
            if (!$this->catchExceptions) {
                throw $e;
            }

            $exitCode = $e->getCode();
            if (is_numeric($exitCode)) {
                $exitCode = (int) $exitCode;
                if (0 === $exitCode) {
                    $exitCode = 1;
                }
            } else {
                $exitCode = 1;
            }
        }

        if ($this->autoExit) {
            if ($exitCode > 255) {
                $exitCode = 255;
            }
            exit($exitCode);
        }

        return $exitCode;
    }

    public function doRun($input, $output)
    {
        $name = '';  //分析命令行 获取要执行的命令
        $command = $this->find($name); //查找匹配命令

        $this->runningCommand = $command;
        $exitCode = $this->doRunCommand($command, $input, $output); //执行命令
        $this->runningCommand = null;

        return $exitCode;

    }

    public function getSchedule() {
        static $schedule;
        if (is_null($schedule))
        {
            $schedule =  new Schedule;
        }
        return $schedule;
    }


    public function terminate() {

    }

}