<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;


    public static function get($refundId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($refundId, 'refundId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/refund/$refundId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Refund();
        $ret->fromJson($json);
        return $ret;
    }

}
