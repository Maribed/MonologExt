<?php

namespace MonologExt\ClassLoader;

use Monolog\Processor\UidProcessor;

class ProcessorLoader extends AbstractClassLoader
{
    private static $defaultMethod = 'uidProcessor';

    function getDefaultMethod(){
        return self::$defaultMethod;
    }

    protected function uidProcessor()
    {
        return new UidProcessor();
    }
}
