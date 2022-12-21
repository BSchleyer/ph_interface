<?php



class PteroProductsStorage extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_storage", $dependencyInjector, $value, $key);
    }
}
