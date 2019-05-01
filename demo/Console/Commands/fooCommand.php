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
	 * 指行命令： php demo/artisan jelly:foo --example 选项值 参数值1 参数值2
	 * 当前命令帮助： php demo/artisan help jelly:foo 或者 php demo/artisan  jelly:foo --help
	 * @return mixed
	 */
	public function handle()
	{
        echo "all options: " . var_export($this->option(), true) . PHP_EOL; //打印所有选项
        echo "--example=" . $this->option('example') . PHP_EOL ;

        echo "all argument: " . var_export($this->argument(), true) . PHP_EOL; //打印所有参数 参数名=值的格式
        echo "pwd值为" . $this->argument('pwd') . PHP_EOL;
        echo __METHOD__ . PHP_EOL;
	}

	/**
	 * Get the console command arguments.
	 * 定义参数规则
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['username', InputArgument::REQUIRED, 'argument intro-用户名.'],//对应cli第1个参数
			['pwd', InputArgument::REQUIRED, 'argument intro-密码.'],//对应cli第2个参数
			['sex', InputArgument::OPTIONAL, 'argument intro-性别可选.', "默认值123"],
		];
	}

	/**
	 * Get the console command options.
	 * 定义选项规则
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'option intro.', null], //匹配 --example=选项值（注意：=号两边没有空格） 或者 --example 选项值
		];
	}

}
