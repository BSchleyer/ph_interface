<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalConstants;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;


    public static function searchTransactions($agreementId, $params = array(), $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($agreementId, 'agreementId');
        ArgumentValidator::validate($params, 'params');

        $allowedParams = array(
            'start_date' => 1,
            'end_date' => 1,
        );

        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/billing-agreements/$agreementId/transactions?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new AgreementTransactions();
        $ret->fromJson($json);
        return $ret;
    }

}
