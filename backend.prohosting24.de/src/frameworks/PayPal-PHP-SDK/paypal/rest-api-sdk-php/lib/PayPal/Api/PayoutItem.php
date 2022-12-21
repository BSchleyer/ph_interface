<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;


    public static function cancel($payoutItemId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($payoutItemId, 'payoutItemId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/payouts-item/$payoutItemId/cancel",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PayoutItemDetails();
        $ret->fromJson($json);
        return $ret;
    }
}
