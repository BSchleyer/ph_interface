<?php


class CreditLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_log_credit", $dependencyInjector, $value, $key);
    }
}