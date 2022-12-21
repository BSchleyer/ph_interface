<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Validation\ArgumentValidator;
use PayPal\Api\VerifyWebhookSignatureResponse;
use PayPal\Rest\ApiContext;
use PayPal\Validation\UrlValidator;


    public function post($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();

        $json = self::executeCall(
            "/v1/notifications/verify-webhook-signature",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new VerifyWebhookSignatureResponse();
        $ret->fromJson($json);
        return $ret;
    }

    public function toJSON($options = 0)
    {
        if (!is_null($this->request_body)) {
            $valuesToEncode = $this->toArray();
            unset($valuesToEncode['webhook_event']);
            unset($valuesToEncode['request_body']);

            $payLoad = "{";
            foreach ($valuesToEncode as $field => $value) {
                $payLoad .= "\"$field\": \"$value\",";
            }
            $payLoad .= "\"webhook_event\": $this->request_body";
            $payLoad .= "}";
            return $payLoad;
        } else {
            $payLoad = parent::toJSON($options);
            return $payLoad;
        }
    }
}
