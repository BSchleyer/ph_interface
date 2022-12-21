<?php

namespace PayPal\Converter;

class FormatConverter
{
    
    public static function formatToPrice($value, $currency = null)
    {
        $decimals = 2;
        $currencyDecimals = array('JPY' => 0, 'TWD' => 0, 'HUF' => 0);
        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (strpos($value, ".") !== false && (floor($value) != $value)) {
                
                throw new \InvalidArgumentException("value cannot have decimals for $currency currency");
            }
            $decimals = $currencyDecimals[$currency];
        } elseif (strpos($value, ".") === false) {
            
            $decimals = 0;
        }
        return self::formatToNumber($value, $decimals);
    }
}
