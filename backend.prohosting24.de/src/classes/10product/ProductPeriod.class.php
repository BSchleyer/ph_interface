<?php


namespace PH24\product;

use BaseDatabase;

class ProductPeriod extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_period", $dependencyInjector, $value, $key);
    }
}