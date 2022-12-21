<?php


namespace PH24\order;


use BaseDatabase;
use PH24\contract\ContractType;
use PH24\product\Period;

class Order extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_main", $dependencyInjector, $value, $key);
    }

    public function checkDefaultProductData($productData)
    {
        foreach ($productData as $product){
            if(!isset($product["productid"]) || !isset($product["config"]) || !isset($product["options"]) || !isset($product["addons"])){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidData"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
            if(isset($product["discount"])){
                $discount = new \Discount($this->dependencyInjector, null);
                $discount = $discount->getAll(["code" => $product["discount"]]);
                if(count($discount) != 1){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidDiscount"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
                $discount = $discount[0];
                if(!$discount->checkDiscount($discount["discount"])){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidDiscount"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
            }
            if(!isset($product["period"]) && !isset($product["contract"])){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidPeriod"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
            if(isset($product["period"])){
                $period = new Period($this->dependencyInjector, null);
                $period = $period->getAll(["days" => $product["period"]]);
                if(count($period) != 1){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidPeriod"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
                if(!$period[0]->checkPeriod($product["productid"])){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidPeriod"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
            } else {
                $contractType = new ContractType($this->dependencyInjector, null);
                $contractType = $contractType->getAll(["contractperiod" => $product["contract"]]);
                if(count($contractType) != 1){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidPeriod"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
                if(!$contractType[0]->checkContract($product["productid"])){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidPeriod"));
                    $this->dependencyInjector->setFail(true);
                    return $this->dependencyInjector;
                }
            }
        }
    }

    public function createProducts($productData)
    {
        $this->checkDefaultProductData($productData);
        if($this->dependencyInjector->isFail()){
            return $this->dependencyInjector;
        }
        foreach ($productData as $productInfo){
            $product = new OrderProduct($this->dependencyInjector, null);
            $product->createFromRaw($productInfo, $this->getValue("id"));
            if($this->dependencyInjector->isFail()){
                return $this->dependencyInjector;
            }
        }
    }
}