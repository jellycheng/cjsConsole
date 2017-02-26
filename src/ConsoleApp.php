<?php
namespace CjsConsole;


class ConsoleApp {

    protected static $instance = null;

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


    public function handle()
    {



    }




}