<?php

namespace PayPal\Log;

use Psr\Log\LoggerInterface;


    public function getLogger($className)
    {
        return new PayPalLogger($className);
    }
}
