<?php


class TrafficNotifyLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_traffic_notify_log", $dependencyInjector, $value, $key);
    }
}