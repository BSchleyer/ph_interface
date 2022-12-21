<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Validation\UrlValidator;


    public static function generateNumber($apiContext = null, $restCall = null)
    {
        $payLoad = "";
        $json = self::executeCall(
            "/v1/invoicing/invoices/next-invoice-number",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new InvoiceNumber();
        $ret->fromJson($json);
        return $ret;
    }

}
