<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalConstants;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;


    public static function all($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
                    'count' => 1,
                    'start_id' => 1,
                    'start_index' => 1,
                    'start_time' => 1,
                    'end_time' => 1,
                    'payee_id' => 1,
                    'sort_by' => 1,
                    'sort_order' => 1,
        );
        $json = self::executeCall(
            "/v1/payments/payment?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PaymentHistory();
        $ret->fromJson($json);
        return $ret;
    }

}
