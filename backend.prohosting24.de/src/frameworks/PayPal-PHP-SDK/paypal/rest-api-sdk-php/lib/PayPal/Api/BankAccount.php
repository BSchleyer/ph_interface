<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function removeLink($links)
    {
        return $this->setLinks(
            array_diff($this->getLinks(), array($links))
        );
    }

}
