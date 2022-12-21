<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Validation\UrlValidator;


    public function removeExternalFunding($externalFunding)
    {
        return $this->setExternalFunding(
            array_diff($this->getExternalFunding(), array($externalFunding))
        );
    }

}
