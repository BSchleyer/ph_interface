<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Validation\UrlValidator;


    public function getCancelUrl()
    {
        return $this->cancel_url;
    }

}
