<?php

namespace PayPal\Security;


    public function decrypt($input)
    {
        
        $input = base64_decode($input);
        
        $iv = substr($input, 0, Cipher::IV_SIZE);
        
        return openssl_decrypt(substr($input, Cipher::IV_SIZE), "AES-256-CBC", $this->secretKey, 0, $iv);
    }
}
