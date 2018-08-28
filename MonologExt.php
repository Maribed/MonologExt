<?php

namespace MonologExt;

use MonologExt\ClassLoader\FormatterLoader;
use MonologExt\ClassLoader\HandlerLoader;
use MonologExt\ClassLoader\ProcessorLoader;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;

class MonologExt
{
    private $config;

    public function __construct()
    {
        $this->config = Config::getConfig();
    }

    /**
     * @param string $logger_name
     * @param string $channel
     * @return Logger
     */
    public function createLogger($logger_name, $channel)
    {
        try {

            $logger = new Logger($channel);

            $handler_list = $this->config['loggers'][$logger_name]['handlers'];
            if (!$handler_list) {
                throw new \Exception('Not set handler in config');
            }

            foreach ($handler_list as $handler) {

                $handlerClass = $this->loadHandler($handler);

                // установка форматирования, если указана в конфиге
                if ($loadFormatter = $this->loadFormatter($this->config['handlers'][$handler]['formatter'])) {
                    $handlerClass->setFormatter($loadFormatter);
                }

                $logger->pushHandler($handlerClass);
            }

            if ($processor = $this->loadProcessor($this->config['loggers'][$logger_name]['processor'])) {
                $logger->pushProcessor($processor);
            }

            return $logger;
        } catch (\Exception $e){
            echo "Error logging: " . $e->getMessage() . "\n";
        }
    }

    /**
     * @param string $type
     * @return HandlerInterface
     */
    private function loadHandler($type)
    {
        $params_handler = $this->config['handlers'][$type];
        $handlerLoader = new HandlerLoader();

        return $handlerLoader->getNewClass($params_handler);
    }

    /**
     * @param string $type
     * @return NormalizerFormatter
     */
    private function loadFormatter($type)
    {
        $params_formatters = $this->config['formatters'][$type];
        $formattersLoader = new FormatterLoader();

        return $formattersLoader->getNewClass($params_formatters);
    }

    private function loadProcessor($type) {
        $params_processor = $this->config['processors'][$type];
        $processorLoader = new ProcessorLoader();

        return $processorLoader->getNewClass($params_processor);
    }
}
