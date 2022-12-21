<?php


class HourlyValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_values", $dependencyInjector, $value, $key);
    }
}
