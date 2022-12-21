<?php

namespace PayPal\Core;

use PayPal\Exception\PayPalConfigurationException;


    public function getHttpConstantsFromConfigs($configs = array(), $prefix)
    {
        $arr = array();
        if ($prefix != null && is_array($configs)) {
            foreach ($configs as $k => $v) {
                
                if (substr($k, 0, strlen($prefix)) === $prefix) {
                    $newKey = ltrim($k, $prefix);
                    if (defined($newKey)) {
                        $arr[constant($newKey)] = $v;
                    }
                }
            }
        }
        return $arr;
    }
}
