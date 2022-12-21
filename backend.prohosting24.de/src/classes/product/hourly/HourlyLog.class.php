<?php


class HourlyLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_log", $dependencyInjector, $value, $key);
    }
}
