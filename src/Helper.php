<?php
namespace CjsConsole;

use Closure;
use CjsConsole\ConsoleConfig;
function base_path(){

    $path = ConsoleConfig::getInstance()->getCrontabEntryPath();
    return $path;

}


/**
 * 是否维护状态
 */
function isDownForMaintenance()
{
    return ConsoleConfig::getInstance()->isDownForMaintenance();
}

function share(Closure $closure)
{
    return function($container) use ($closure)
    {
        static $object;
        if (is_null($object))
        {
            $object = $closure($container);
        }
        return $object;
    };
}

