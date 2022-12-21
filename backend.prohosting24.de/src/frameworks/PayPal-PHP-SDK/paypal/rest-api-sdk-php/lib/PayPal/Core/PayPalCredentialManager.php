<?php

namespace PayPal\Core;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalInvalidCredentialException;


    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
