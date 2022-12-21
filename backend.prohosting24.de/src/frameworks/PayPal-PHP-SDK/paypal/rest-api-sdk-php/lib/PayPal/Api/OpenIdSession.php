<?php
namespace PayPal\Api;


use PayPal\Core\PayPalConstants;
use PayPal\Rest\ApiContext;

class OpenIdSession
{

    
    private static function getBaseUrl($config)
    {

        if (array_key_exists('openid.RedirectUri', $config)) {
            return $config['openid.RedirectUri'];
        } else if (array_key_exists('mode', $config)) {
            switch (strtoupper($config['mode'])) {
                case 'SANDBOX':
                    return PayPalConstants::OPENID_REDIRECT_SANDBOX_URL;
                case 'LIVE':
                    return PayPalConstants::OPENID_REDIRECT_LIVE_URL;
            }
        }
        return null;
    }
}
