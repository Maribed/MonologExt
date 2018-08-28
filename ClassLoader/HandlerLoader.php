<?php

namespace MonologExt\ClassLoader;

use Monolog\Handler\StreamHandler;

class HandlerLoader extends AbstractClassLoader
{

    private static $defaultMethod = 'streamHandler';

    function getDefaultMethod(){
        return self::$defaultMethod;
    }

    protected function streamHandler($params)
    {
        if (!$stream = $params['stream']) {
            $stream = \FF\Config\Path::getCronLogs() . "/" . 'cron_error.log';
        }

        $level = $params['level'];
        if (!$level || !defined('Monolog\Logger::' . $level)) {
            $level = 'INFO';
        }

        return new StreamHandler($stream, constant('Monolog\Logger::' . $level));
    }
}
