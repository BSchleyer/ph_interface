<?php


namespace PH24\order;


use BaseDatabase;

class OrderProductConfig extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product_config", $dependencyInjector, $value, $key);
    }
}