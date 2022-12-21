<?php


class ApiLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_api_log", $dependencyInjector, $value, $key);
    }
}