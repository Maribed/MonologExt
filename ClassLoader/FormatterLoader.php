<?php

namespace MonologExt\ClassLoader;

use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\LogstashFormatter;

class FormatterLoader extends AbstractClassLoader
{

    private static $defaultMethod = 'lineFormatter';

    function getDefaultMethod(){
        return self::$defaultMethod;
    }

    protected function lineFormatter($params)
    {
        $dateFormat = $params['dateFormat'];
        $output = $params['format'];

        return new LineFormatter($output, $dateFormat);
    }

    protected function logstashFormatter($params)
    {
        return $formatter = new LogstashFormatter($params['applicationName']);
    }

}
