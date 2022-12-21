<?php


namespace PH24\order;


use BaseDatabase;

class OrderLogData extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_log_data", $dependencyInjector, $value, $key);
    }
}