<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeInvoice($invoice)
    {
        return $this->setInvoices(
            array_diff($this->getInvoices(), array($invoice))
        );
    }

}
