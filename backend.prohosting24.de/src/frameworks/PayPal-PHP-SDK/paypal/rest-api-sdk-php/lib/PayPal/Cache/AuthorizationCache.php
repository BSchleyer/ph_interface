<?php

namespace PayPal\Cache;

use PayPal\Core\PayPalConfigManager;
use PayPal\Validation\JsonValidator;

abstract class AuthorizationCache
{
    public static $CACHE_PATH = '/../../../var/auth.cache';

    
    private static function getConfigValue($key, $config)
    {
        $config = ($config && is_array($config)) ? $config : PayPalConfigManager::getInstance()->getConfigHashmap();
        return (array_key_exists($key, $config)) ? trim($config[$key]) : null;
    }
}
