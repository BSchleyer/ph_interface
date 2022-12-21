<?php
namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;


    public function createFromRefreshToken($params, $apiContext = null, $restCall = null)
    {
        static $allowedParams = array('grant_type' => 1, 'refresh_token' => 1, 'scope' => 1);
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);

        if (!array_key_exists('grant_type', $params)) {
            $params['grant_type'] = 'refresh_token';
        }
        if (!array_key_exists('refresh_token', $params)) {
            $params['refresh_token'] = $this->getRefreshToken();
        }

        $clientId = isset($params['client_id']) ? $params['client_id'] : $apiContext->getCredential()->getClientId();
        $clientSecret = isset($params['client_secret']) ? $params['client_secret'] : $apiContext->getCredential()->getClientSecret();

        $json = self::executeCall(
            "/v1/identity/openidconnect/tokenservice",
            "POST",
            http_build_query(array_intersect_key($params, $allowedParams)),
            array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($clientId . ":" . $clientSecret)
            ),
            $apiContext,
            $restCall
        );

        $this->fromJson($json);
        return $this;
    }
}
