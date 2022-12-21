<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;


    public function update($apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getTemplateId(), "Id");
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/v1/invoicing/templates/{$this->getTemplateId()}",
            "PUT",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

}
