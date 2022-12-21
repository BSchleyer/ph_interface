<?php


namespace PH24\contract;


use BaseDatabase;
use PH24\product\ProductContract;

class ContractType extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("contract_type", $dependencyInjector, $value, $key);
    }

    public function checkContract($productId)
    {
        $productContract = new ProductContract($this->dependencyInjector, null);
        $productContract = $productContract->getAll(["productid" => $productId, "contractid" => $this->getValue("id")]);
        if(count($productContract) != 1){
            return false;
        }
        return true;
    }
}