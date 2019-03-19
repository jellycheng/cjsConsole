<?php namespace ConsoleDemo\Console\Commands;

use CjsConsole\Command;
use CjsConsole\Input\InputOption;
use CjsConsole\Input\InputArgument;

class fooCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jelly:foo';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 * php artisan jelly:foo example=tom
	 * @return mixed
	 */
	public function handle()
	{
		//todo
        var_export($this->option()); //打印所有选项
        echo "--example=" . $this->option('example') . PHP_EOL ;
        var_export($this->argument()); //打印所有参数 参数名=值的格式
        echo "hi, " . $this->argument('example') . PHP_EOL;
        echo __METHOD__ . PHP_EOL;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['user', InputArgument::REQUIRED, 'An user argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null], //匹配 --example=选项值
		];
	}

}
