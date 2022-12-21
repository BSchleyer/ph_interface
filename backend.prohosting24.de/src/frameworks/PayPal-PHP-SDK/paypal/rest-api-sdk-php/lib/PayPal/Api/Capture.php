<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;


    public function refundCapturedPayment($refundRequest, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($refundRequest, 'refundRequest');
        $payLoad = $refundRequest->toJSON();
        $json = self::executeCall(
            "/v1/payments/capture/{$this->getId()}/refund",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new DetailedRefund();
        $ret->fromJson($json);
        return $ret;
    }

}
