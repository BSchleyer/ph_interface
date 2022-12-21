<?php


class HourlyLimits extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_limits", $dependencyInjector, $value, $key);
    }

}