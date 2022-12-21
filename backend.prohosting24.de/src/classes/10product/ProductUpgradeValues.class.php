<?php


namespace PH24\product;

use BaseDatabase;

class ProductUpgradeValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_upgrade_values", $dependencyInjector, $value, $key);
    }
}