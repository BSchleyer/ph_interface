<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeChargeModel($chargeModel)
    {
        return $this->setChargeModels(
            array_diff($this->getChargeModels(), array($chargeModel))
        );
    }

}
