<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeCcEmail($string)
    {
        return $this->setCcEmails(
            array_diff($this->getCcEmails(), array($string))
        );
    }

}
