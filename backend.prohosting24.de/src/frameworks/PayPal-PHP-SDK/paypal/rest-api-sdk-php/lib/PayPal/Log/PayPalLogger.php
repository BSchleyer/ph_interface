<?php

namespace PayPal\Log;

use PayPal\Core\PayPalConfigManager;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class PayPalLogger extends AbstractLogger
{

    
    private $loggerName;

    public function __construct($className)
    {
        $this->loggerName = $className;
        $this->initialize();
    }

    public function initialize()
    {
        $config = PayPalConfigManager::getInstance()->getConfigHashmap();
        if (!empty($config)) {
            $this->isLoggingEnabled = (array_key_exists('log.LogEnabled', $config) && $config['log.LogEnabled'] == '1');
            if ($this->isLoggingEnabled) {
                $this->loggerFile = ($config['log.FileName']) ? $config['log.FileName'] : ini_get('error_log');
                $loggingLevel = strtoupper($config['log.LogLevel']);
                $this->loggingLevel = (isset($loggingLevel) && defined("\\Psr\\Log\\LogLevel::$loggingLevel")) ?
                    constant("\\Psr\\Log\\LogLevel::$loggingLevel") :
                    LogLevel::INFO;
            }
        }
    }

    public function log($level, $message, array $context = array())
    {
        if ($this->isLoggingEnabled) {
            
            if (array_search($level, $this->loggingLevels) <= array_search($this->loggingLevel, $this->loggingLevels)) {
                error_log("[" . date('d-m-Y H:i:s') . "] " . $this->loggerName . " : " . strtoupper($level) . ": $message\n", 3, $this->loggerFile);
            }
        }
    }
}
