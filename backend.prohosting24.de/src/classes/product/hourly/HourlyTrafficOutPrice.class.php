<?php


class HourlyTrafficOutPrice extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_traffic_out_price", $dependencyInjector, $value, $key);
    }
}
