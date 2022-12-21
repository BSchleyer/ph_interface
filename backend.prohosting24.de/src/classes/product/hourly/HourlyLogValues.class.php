<?php


class HourlyLogValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_log_values", $dependencyInjector, $value, $key);
    }
}
