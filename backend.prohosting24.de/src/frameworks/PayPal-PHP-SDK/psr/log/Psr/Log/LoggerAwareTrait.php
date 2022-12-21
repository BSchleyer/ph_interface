<?php

namespace Psr\Log;


    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
