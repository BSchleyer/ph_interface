<?php


namespace PH24\product;

use BaseDatabase;

class Product extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_main", $dependencyInjector, $value, $key);
    }

    public function checkConfig($data)
    {
        $productUpgrades = new ProductUpgrades($this->dependencyInjector, null);
        $productUpgrades = $productUpgrades->getAll(["produktid" => $this->getValue("id")]);
        $productUpgradeData = [];
        foreach ($productUpgrades as $upgradeData){
            $productUpgradeData[$upgradeData->getValue("name")] = $upgradeData->getValues();
        }

        foreach ($data["config"] as $config){
            if(!isset($productUpgradeData[$config["key"]][$config["value"]])){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
            unset($productUpgradeData[$config["key"]]);
        }
        if(count($productUpgradeData) != 0){
            $this->dependencyInjector->setResponseCode(400);
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
            $this->dependencyInjector->setFail(true);
            return $this->dependencyInjector;
        }

        $productOptions = new ProductOption($this->dependencyInjector, null);
        $productOptions = $productOptions->getAll(["productid" => $this->getValue("id")]);
        $productOptionData = [];
        foreach ($productOptions as $upgradeData){
            $productOptionData[$upgradeData->getValue("name")] = $upgradeData;
            if($this->dependencyInjector->isFail()){
                return $this->dependencyInjector;
            }
        }

        foreach ($data["options"] as $option){
            if(!isset($productOptionData[$option["key"]])){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
            $productOptionData[$option["key"]]->validate($option["value"]);
            if($this->dependencyInjector->isFail()){
                return $this->dependencyInjector;
            }
            unset($productOptionData[$option["key"]]);
        }
        foreach ($productOptionData as $optionData){
            if($optionData->getValue('required') == 1){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
        }
        $productAddons = new ProductAddon($this->dependencyInjector, null);
        $productAddons = $productAddons->getAll(["productid" => $this->getValue("id")]);

        $productAddonData = [];
        foreach ($productAddons as $addon){
            $productAddonData[$addon->getValue("name")] = $addon;
        }

        foreach ($data["addons"] as $addon){
            if(!isset($productAddonData[$addon["key"]])){
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
            }
            $productAddonData[$addon["key"]]->validate($addon["value"]);
            if($this->dependencyInjector->isFail()){
                return $this->dependencyInjector;
            }
        }
    }

    public function getDiscountRaw($data)
    {
        if(!isset($data["discount"])){
            return null;
        }
        $discount = new \Discount($this->dependencyInjector, $data["discount"], "code");
        $discount->redeem();
        return $discount->getValue("id");
    }

    public function calcPriceRaw($data)
    {
        $basePrice = $this->getValue("price");
        $productUpgrades = new ProductUpgrades($this->dependencyInjector, null);
        $productUpgrades = $productUpgrades->getAll(["produktid" => $this->getValue("id")]);
        $productUpgradeData = [];
        foreach ($productUpgrades as $upgradeData){
            $productUpgradeData[$upgradeData->getValue("name")] = $upgradeData->getValues();
        }

        foreach ($data["config"] as $config){
            $basePrice += $productUpgradeData[$config["key"]][$config["value"]]["price"];
        }

        $productAddons = new ProductAddon($this->dependencyInjector, null);
        $productAddons = $productAddons->getAll(["productid" => $this->getValue("id")]);

        $productAddonData = [];
        foreach ($productAddons as $addon){
            $productAddonData[$addon->getValue("name")] = $addon;
        }

        foreach ($data["addons"] as $addon){
            $basePrice += $productAddonData[$addon["key"]]->getPriceRaw($addon["value"]);
        }
        return $basePrice;
    }

    public function getPeriod($days)
    {
        return new Period($this->dependencyInjector, $days, "days"); 
    }
}