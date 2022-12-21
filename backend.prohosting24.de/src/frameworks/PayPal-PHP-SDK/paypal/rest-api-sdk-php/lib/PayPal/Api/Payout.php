<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;


    public static function get($payoutBatchId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($payoutBatchId, 'payoutBatchId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/payouts/$payoutBatchId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PayoutBatch();
        $ret->fromJson($json);
        return $ret;
    }

}
