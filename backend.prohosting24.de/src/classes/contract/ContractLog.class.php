<?php


namespace PH24\contract;


use BaseDatabase;

class ContractLog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("contract_log", $dependencyInjector, $value, $key);
    }
}