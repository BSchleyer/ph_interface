<?php


class TrafficHourlyInLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_traffic_hourly_in_log", $dependencyInjector, $value, $key);
    }
}