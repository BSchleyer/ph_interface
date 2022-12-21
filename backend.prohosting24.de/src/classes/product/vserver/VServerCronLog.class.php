<?php


class VServerCronLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_crons_log", $dependencyInjector, $value, $key);
    }
}