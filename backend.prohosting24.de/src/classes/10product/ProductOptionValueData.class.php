<?php


namespace PH24\product;

use BaseDatabase;

class ProductOptionValueData extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_option_value_data", $dependencyInjector, $value, $key);
    }
}