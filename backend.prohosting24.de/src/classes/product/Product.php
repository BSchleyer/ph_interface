<?php


class Product extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_main", $dependencyInjector, $value, $key);
    }
}