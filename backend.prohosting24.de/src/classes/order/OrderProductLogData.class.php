<?php


namespace PH24\order;


use BaseDatabase;

class OrderProductLogData extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product_log_data", $dependencyInjector, $value, $key);
    }
}