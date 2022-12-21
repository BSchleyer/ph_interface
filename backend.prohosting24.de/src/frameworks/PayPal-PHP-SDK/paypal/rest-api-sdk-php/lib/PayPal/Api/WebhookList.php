<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeWebhook($webhook)
    {
        return $this->setWebhooks(
            array_diff($this->getWebhooks(), array($webhook))
        );
    }

}
