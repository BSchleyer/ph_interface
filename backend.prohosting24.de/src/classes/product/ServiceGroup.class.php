<?php


class ServiceGroup extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("service_groups", $dependencyInjector, $value, $key);
    }
}