<?php

namespace PayPal\Auth;

use PayPal\Cache\AuthorizationCache;
use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalHttpConfig;
use PayPal\Core\PayPalHttpConnection;
use PayPal\Core\PayPalLoggingManager;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Handler\IPayPalHandler;
use PayPal\Rest\ApiContext;
use PayPal\Security\Cipher;


    public function decrypt($data)
    {
        return $this->cipher->decrypt($data);
    }
}
