<?php


namespace PH24\order;


use BaseDatabase;

class OrderProductAddon extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product_addon", $dependencyInjector, $value, $key);
    }
}