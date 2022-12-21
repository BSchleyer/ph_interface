<?php


class HourlyTrafficIn extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_traffic_in", $dependencyInjector, $value, $key);
    }
}
