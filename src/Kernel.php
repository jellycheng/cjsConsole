<?php
namespace CjsConsole;


class Kernel {

    public function __construct()
    {

        $this->defineConsoleSchedule();
    }


    protected function defineConsoleSchedule()
    {
        $this->app->instance(
            'Illuminate\Console\Scheduling\Schedule', $schedule = new Schedule
        );

        $this->schedule($schedule);
    }


}