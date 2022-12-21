<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;


    public function authorize($authorization, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($authorization, 'Authorization');
        $payLoad = $authorization->toJSON();
        $json = self::executeCall(
            "/v1/payments/orders/{$this->getId()}/authorize",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Authorization();
        $ret->fromJson($json);
        return $ret;
    }

}
