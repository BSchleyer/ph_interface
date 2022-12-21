<?php


class TrafficOutLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_traffic_out_log", $dependencyInjector, $value, $key);
    }
}