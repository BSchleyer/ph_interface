<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Validation\JsonValidator;


    public static function all($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
          'page_size' => 1,
          'start_time' => 1,
          'end_time' => 1,
          'transaction_id' => 1,
          'event_type' => 1,
      );
        $json = self::executeCall(
            "/v1/notifications/webhooks-events" . "?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookEventList();
        $ret->fromJson($json);
        return $ret;
    }

}
