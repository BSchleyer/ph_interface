<?php


namespace PH24\product;

use BaseDatabase;

class ProductContract extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_contract", $dependencyInjector, $value, $key);
    }
}