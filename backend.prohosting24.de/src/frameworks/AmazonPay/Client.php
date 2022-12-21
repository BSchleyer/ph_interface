<?php
namespace AmazonPay;


    public static function getSignature($stringToSign, $secretKey)
    {
        return base64_encode(hash_hmac('sha256', $stringToSign, $secretKey, true));
    }

}
