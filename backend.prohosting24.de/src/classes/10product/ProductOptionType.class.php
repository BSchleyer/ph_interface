<?php


namespace PH24\product;

use BaseDatabase;

class ProductOptionType extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_option_type", $dependencyInjector, $value, $key);
    }
}