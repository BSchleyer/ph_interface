<?php

namespace PayPal\Core;

use PayPal\Log\PayPalLogFactory;
use Psr\Log\LoggerInterface;


    public function debug($message)
    {
        $config = PayPalConfigManager::getInstance()->getConfigHashmap();
        
        if (array_key_exists('mode', $config) && $config['mode'] != 'live') {
            $this->logger->debug($message);
        }
    }
}
