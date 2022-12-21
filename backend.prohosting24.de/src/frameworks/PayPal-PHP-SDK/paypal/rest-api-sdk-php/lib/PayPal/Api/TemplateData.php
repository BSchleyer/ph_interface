<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Validation\UrlValidator;


    public function removeAttachment($fileAttachment)
    {
        return $this->setAttachments(
            array_diff($this->getAttachments(), array($fileAttachment))
        );
    }

}
