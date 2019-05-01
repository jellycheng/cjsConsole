<?php
namespace ConsoleDemo\Commands;

use CjsConsole\Command;
use ConsoleDemo\Inspiring;

class Inspire extends Command {

    /**
     * The console command name.
     * 命令名
     * @var string
     */
    protected $name = 'inspire';

    /**
     * The console command description.
     * 命令描述
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     * 执行命令：php demo/artisan inspire 则调用这个方法
     * @return mixed
     */
    public function handle()
    {
        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }

}

