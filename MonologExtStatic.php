<?php
namespace FF\Log\MonologExt;

use Monolog\Logger;

/**
 * Class MonologExtStatic
 * @package FF\Log\MonologExt
 */
class MonologExtStatic
{
    /**
     * @var Logger
     */
    private static $logger;

    /**
     * @var string
     */
    private static $logger_name;
    
    /**
     * @var string
     */
    private static $channel;

    /**
     * @return Logger
     */
    public static function getLogger()
    {
        if (
            !self::$logger
            || !self::$logger instanceof Logger
            || self::$logger->getName() != self::getChannel()
        ) {
            $loggermonolog = new MonologExt();
            self::$logger = $loggermonolog->createLogger(self::getLoggerName(), self::getChannel());
        }

        return self::$logger;
    }

    /**
     * @param string $logger_name
     */
    public static function setLoggerName($logger_name)
    {
        self::$logger_name = $logger_name;
    }

    /**
     * @return string
     */
    public static function getLoggerName()
    {
        return self::$logger_name;
    }

    /**
     * @param string $channel
     */
    public static function setChannel($channel)
    {
        self::$channel = $channel;
    }

    /**
     * @return string
     */
    public static function getChannel()
    {
        return self::$channel;
    }

    /**
     * @param $path_file_php
     * @param array $replace_param
     */
    public static function loadConfig($path_file_php, $replace_param = [])
    {
        Config::setConfig($path_file_php, $replace_param);
    }
}
