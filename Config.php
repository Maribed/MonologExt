<?php
namespace MonologExt;

class Config
{

    public static $config;

    public static function setConfig($path_file_php, $replace_params)
    {
        $config = require $path_file_php;
        self::$config = array_merge_recursive($config, $replace_params);;
    }

    /**
     * @return mixed
     */
    public static function getConfig()
    {
        return self::$config;
    }

}
