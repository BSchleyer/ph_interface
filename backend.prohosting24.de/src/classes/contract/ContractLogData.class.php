<?php


namespace PH24\contract;


use BaseDatabase;

class ContractLogData extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("contract_log_data", $dependencyInjector, $value, $key);
    }
}