<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;
use PayPal\Validation\UrlValidator;


    public function removePostbackData($nameValuePair)
    {
        return $this->setPostbackData(
            array_diff($this->getPostbackData(), array($nameValuePair))
        );
    }

}
