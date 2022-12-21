<?php

namespace PayPal\Validation;


    public static function validate($argument, $argumentName = null)
    {
        if ($argument === null) {
            
            throw new \InvalidArgumentException("$argumentName cannot be null");
        } elseif (gettype($argument) == 'string' && trim($argument) == '') {
            
            throw new \InvalidArgumentException("$argumentName string cannot be empty");
        }
        return true;
    }
}
