<?php


namespace PH24\product;

use BaseDatabase;

class Period extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_period", $dependencyInjector, $value, $key);
    }

    public function checkPeriod($productId)
    {
        $productPeriod = new ProductPeriod($this->dependencyInjector, null);
        $productPeriod = $productPeriod->getAll(["productid" => $productId, "periodid" => $this->getValue("id")]);
        if(count($productPeriod) != 1){
            return false;
        }
        return true;
    }
}