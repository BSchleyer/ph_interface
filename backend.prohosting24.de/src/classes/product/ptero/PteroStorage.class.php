<?php



class PteroStorage extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_main_storage", $dependencyInjector, $value, $key);
    }
}
