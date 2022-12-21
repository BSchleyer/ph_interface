<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function getFailedPaymentCount()
    {
        return $this->failed_payment_count;
    }

}
