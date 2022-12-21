<?php


class PteroProductsVariablesValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_variables_values", $dependencyInjector, $value, $key);
    }
}
