<?php


namespace PH24\order;


use BaseDatabase;

class OrderProductLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product_log", $dependencyInjector, $value, $key);
    }
}