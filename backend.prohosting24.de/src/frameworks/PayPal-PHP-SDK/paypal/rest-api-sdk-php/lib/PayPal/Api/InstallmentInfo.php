<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeInstallmentOption($installmentOption)
    {
        return $this->setInstallmentOptions(
            array_diff($this->getInstallmentOptions(), array($installmentOption))
        );
    }

}
