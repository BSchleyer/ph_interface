<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeTransaction($transaction)
    {
        return $this->setTransactions(
            array_diff($this->getTransactions(), array($transaction))
        );
    }

}
