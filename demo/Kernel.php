<?php
namespace ConsoleDemo;

use CjsConsole\Scheduling\Schedule;
use CjsConsole\Kernel as ConsoleKernel;

//file: App/Console/Kernel.php
class Kernel extends ConsoleKernel {

    //配置命令,这里配置后，则可以使用 php artisan 命令名 来调用，如 php demo/artisan inspire
    protected $commands = [
                            'ConsoleDemo\Commands\Inspire',
                            'ConsoleDemo\Console\Commands\fooCommand',
                            //'ConsoleDemo\Console\Commands\abc',
                            ];


    //时间计划表配置  * * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('inspire')->hourly();

        //$schedule->command('command:contract_timeout')->dailyAt('00:00');

        //$schedule->command('report:finance yesterday')->dailyAt('03:00');

		//$schedule->command('command:paymentaccountcheck')->cron('50 * * * *');
        //$schedule->command('command:consume_order_coupon')->hourly();
        //$schedule->command('命令名 参数值1 参数值N --选项名1 选项值1 --选项名2 选项值2')->everyTenMinutes();

        $schedule->exec('ls -l')->cron('* * * * *')->then(function(){
                echo "ls -l 执行完毕" . PHP_EOL;
        });

        //设置只在指定环境运行
        $schedule->command('inspire')->cron('* * * * *')->environments('dev');

    }


}