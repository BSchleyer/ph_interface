<?php


class HourlyTrafficOut extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_traffic_out", $dependencyInjector, $value, $key);
    }
}
