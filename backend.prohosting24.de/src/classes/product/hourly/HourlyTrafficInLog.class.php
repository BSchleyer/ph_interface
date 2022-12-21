<?php


class HourlyTrafficInLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_traffic_in_log", $dependencyInjector, $value, $key);
    }
}
