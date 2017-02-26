<?php
namespace CjsConsole;

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

