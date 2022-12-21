<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$discount = new Discount($masterdatabase, $config);
$response->setresponse($discount->getall());
