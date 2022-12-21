<?php


class HourlyTrafficOutLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_traffic_out_log", $dependencyInjector, $value, $key);
    }
}
