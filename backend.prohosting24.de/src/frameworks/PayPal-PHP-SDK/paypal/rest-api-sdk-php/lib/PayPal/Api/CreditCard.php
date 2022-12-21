<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;


    public static function all($params, $apiContext = null, $restCall = null)
    {
        if (is_null($params)) {
            $params = array();
        }
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
            'page_size' => 1,
            'page' => 1,
            'start_time' => 1,
            'end_time' => 1,
            'sort_order' => 1,
            'sort_by' => 1,
            'merchant_id' => 1,
            'external_card_id' => 1,
            'external_customer_id' => 1,
            'total_required' => 1
        );
        $json = self::executeCall(
            "/v1/vault/credit-cards" . "?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new CreditCardList();
        $ret->fromJson($json);
        return $ret;
    }

}
