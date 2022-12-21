<?php


class PteroPacketsValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_packets_values", $dependencyInjector, $value, $key);
    }
}
