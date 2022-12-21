<?php


namespace PH24\main;


use BaseDatabase;

class Status extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_status", $dependencyInjector, $value, $key);
    }
}