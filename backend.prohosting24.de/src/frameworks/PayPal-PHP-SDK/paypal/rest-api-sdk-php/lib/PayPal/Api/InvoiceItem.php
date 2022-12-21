<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;
use PayPal\Validation\UrlValidator;


    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

}
