<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;


    public function saveToFile($name = null)
    {
        
        if (!$name) {
            $name = uniqid() . '.png';
        }
        
        file_put_contents($name, base64_decode($this->getImage()));
        return $name;
    }

}
