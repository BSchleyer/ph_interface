<?php


class PteroValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_main_values", $dependencyInjector, $value, $key);
    }
}
