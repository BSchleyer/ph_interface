<?php


namespace PH24\order;


use BaseDatabase;

class OrderLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_log", $dependencyInjector, $value, $key);
    }
}