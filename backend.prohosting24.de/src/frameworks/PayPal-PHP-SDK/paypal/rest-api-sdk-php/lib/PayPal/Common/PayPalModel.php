<?php

namespace PayPal\Common;

use PayPal\Validation\JsonValidator;


    public function __toString()
    {
        return $this->toJSON(128);
    }
}
