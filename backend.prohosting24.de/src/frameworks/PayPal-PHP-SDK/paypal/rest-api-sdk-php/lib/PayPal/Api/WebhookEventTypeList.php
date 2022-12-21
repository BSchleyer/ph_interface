<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeEventType($webhookEventType)
    {
        return $this->setEventTypes(
            array_diff($this->getEventTypes(), array($webhookEventType))
        );
    }

}
