<?php


namespace PH24\order;


use BaseDatabase;

class OrderProductOption extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product_option", $dependencyInjector, $value, $key);
    }
}