<?php

namespace PayPal\Api;

use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;


    public static function getRefreshToken($authorizationCode, $apiContext = null)
    {
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $credential = $apiContext->getCredential();
        return $credential->getRefreshToken($apiContext->getConfig(), $authorizationCode);
    }

}
