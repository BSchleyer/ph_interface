<?php
namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;


    public static function getUserinfo($params, $apiContext = null, $restCall = null)
    {
        static $allowedParams = array('schema' => 1);

        $params = is_array($params)  ? $params : array();

        if (!array_key_exists('schema', $params)) {
            $params['schema'] = 'openid';
        }
        $requestUrl = "/v1/identity/openidconnect/userinfo?"
            . http_build_query(array_intersect_key($params, $allowedParams));

        $json = self::executeCall(
            $requestUrl,
            "GET",
            "",
            array(
                'Authorization' => "Bearer " . $params['access_token'],
                'Content-Type' => 'x-www-form-urlencoded'
            ),
            $apiContext,
            $restCall
        );

        $ret = new OpenIdUserinfo();
        $ret->fromJson($json);

        return $ret;
    }
}
