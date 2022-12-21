<?php


namespace PH24\order;


use BaseDatabase;
use PH24\contract\Contract;
use PH24\contract\ContractType;
use PH24\product\Product;
use PH24\product\ProductAddon;
use PH24\product\ProductOption;
use PH24\product\ProductUpgrades;

class OrderProduct extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("order_product", $dependencyInjector, $value, $key);
    }

    public function createFromRaw($data, $orderid)
    {
        
        $product = new Product($this->dependencyInjector, null);
        $products = $product->getAll(["id" => $data["productid"]]);
        if(count($products) != 1){
            $this->dependencyInjector->setResponseCode(400);
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidProduct"));
            $this->dependencyInjector->setFail(true);
            return $this->dependencyInjector;
        }
        $product = $products[0];
        $product->checkConfig($data);

        $this->setValue("id", \Functions::gen_uuid());
        $this->setValue("orderid", $orderid);
        $this->setValue("productid", $data["productid"]);
        $this->setValue("status", "orderProductCreated");
        $this->setValue("price", $product->calcPriceRaw($data));
        $this->setValue("discountid", $product->getDiscountRaw($data));
        $this->setValue("periodid", null);
        $this->setValue("contractid", null);
        if(isset($data["contract"])){
            $this->setValue("contractid", $this->createContract($data["contract"]));
        } else {
            if(isset($data["period"])){
                $this->setValue("periodid", $product->getPeriod($data["period"])->getValue("id"));
            }
        }
        $this->create();
        $this->createConfigRaw($data);
    }

    public function createConfigRaw($data)
    {
        foreach ($data["config"] as $config){
            $productUpgrades = new ProductUpgrades($this->dependencyInjector, null);
            
            $productUpgrades = $productUpgrades->getAll(["produktid" => $data["productid"], "name" => $config["key"]])[0];
            $productUpgradeValue = $productUpgrades->getUpgradeValue($config["value"]);
            $orderProductConfig = new OrderProductConfig($this->dependencyInjector, null);
            $orderProductConfig->setValue("orderproductid", $this->getValue("id"));
            $orderProductConfig->setValue("upgradevalueid", $productUpgradeValue->getValue("id"));
            $orderProductConfig->create();
        }

        foreach ($data["options"] as $option){
            $productOption = new ProductOption($this->dependencyInjector ,null);
            
            $productOption = $productOption->getAll(["productid" => $data["productid"], "name" => $option["key"]])[0];

            $value = $productOption->getOptionValue($option["value"]);

            $orderProductOption = new OrderProductOption($this->dependencyInjector, null);
            $orderProductOption->setValue("orderproductid", $this->getValue("id"));
            $orderProductOption->setValue("optionid", $productOption->getValue("id"));
            if(!isset($value)){
                $orderProductOption->setValue("optionvalueid", null);
            } else {
                $orderProductOption->setValue("optionvalueid", $value->getValue("id"));
            }
            $orderProductOption->setValue("value", $option["value"]);
            $orderProductOption->create();
        }

        foreach ($data["addons"] as $addon){
            $productAddon = new ProductAddon($this->dependencyInjector ,null);
            $productAddon = $productAddon->getAll(["productid" => $data["productid"], "name" => $addon["key"]])[0];

            for ($i = 1; $i <= $addon["value"]; $i++){
                $orderProductAddon = new OrderProductAddon($this->dependencyInjector, null);
                $orderProductAddon->setValue("orderproductid", $this->getValue("id"));
                $orderProductAddon->setValue("addonid", $productAddon->getValue("id"));
                $orderProductAddon->create();
            }
        }
    }

    public function createContract($days)
    {
        $contractType = new ContractType($this->dependencyInjector, $days,"contractperiod"); 
        $contract = new Contract($this->dependencyInjector, null);
        $contract->createFromType($contractType);
        return $contract->getValue("id");
    }

}