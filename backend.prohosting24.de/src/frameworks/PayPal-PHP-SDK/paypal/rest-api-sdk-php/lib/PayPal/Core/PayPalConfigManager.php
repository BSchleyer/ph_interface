<?php

namespace PayPal\Core;


    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
