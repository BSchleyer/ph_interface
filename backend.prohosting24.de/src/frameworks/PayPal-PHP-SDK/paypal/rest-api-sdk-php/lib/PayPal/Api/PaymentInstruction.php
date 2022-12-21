<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Validation\ArgumentValidator;


    public static function get($paymentId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($paymentId, 'paymentId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/payment/$paymentId/payment-instruction",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PaymentInstruction();
        $ret->fromJson($json);
        return $ret;
    }

}
