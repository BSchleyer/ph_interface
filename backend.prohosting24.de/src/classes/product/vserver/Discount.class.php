<?php


class Discount extends BaseDatabase
{
    private $discountData = [];

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user_discount", $dependencyInjector, $value, $key);
    }

    public function loadData()
    {
        if(isset($this->discountData["amount"])){
            return;
        }
        $discountValues = new DiscountValue($this->dependencyInjector, null);
        $discountValues = $discountValues->getAll(["discountid" => $this->getValue("id")]);
        foreach ($discountValues as $discountValue){
            switch ($discountValue->getValue('type')){
                case 'amount':
                    $this->discountData["amount"] = $discountValue->getValue('data');
                    break;
                case 'product':
                    if(!isset($this->discountData["product"])){
                        $this->discountData["product"] = [];
                    }
                    $this->discountData["product"][] = $discountValue->getValue('data');
                    break;
            }
        }
    }

    public function checkDiscount($product)
    {
        $this->loadData();
        if(in_array($product,$this->discountData["product"])){
            if($this->getValue("count") > 0){
                return true;
            }
        }
        return false;
    }

    public function getData()
    {
        $this->loadData();
        return $this->discountData;
    }

    public function getPrice($normalPrice)
    {
        $this->loadData();
        return $normalPrice * (($this->discountData["amount"] - 1) * -1);
    }

    public function redeem()
    {
        $this->setValue('count', $this->getValue('count') - 1);
        $this->update();
    }
}