<?php
namespace ConsoleDemo;

use CjsConsole\Scheduling\Schedule;
use CjsConsole\Kernel as ConsoleKernel;
class Kernel extends ConsoleKernel {

    //配置命令
    protected $commands = [
                            'ConsoleDemo\Commands\Inspire',
                            ];


    //时间计划表配置
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();

        $schedule->command('command:contract_timeout')->dailyAt('00:00');

        $schedule->command('report:finance yesterday')->dailyAt('03:00');

		$schedule->command('command:paymentaccountcheck')->cron('50 * * * *');
        $schedule->command('command:consume_order_coupon')->hourly();
        $schedule->command('aaz:withdrawjob')->everyTenMinutes();

    }


}