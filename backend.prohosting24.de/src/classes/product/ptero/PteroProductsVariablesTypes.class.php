<?php


class PteroProductsVariablesTypes extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_variables_types", $dependencyInjector, $value, $key);
    }
}
