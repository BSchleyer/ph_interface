<?php


class ApiLogOld extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_api_log_old", $dependencyInjector, $value, $key);
    }
}