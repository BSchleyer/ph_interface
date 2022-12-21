<?php


namespace PH24\contract;


use BaseDatabase;

class ContractPayment extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("contract_payment", $dependencyInjector, $value, $key);
    }
}