<?php


namespace PH24\product;

use BaseDatabase;

class ProductUpgrades extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_upgrades", $dependencyInjector, $value, $key);
    }

    public function getValues()
    {
        $upgradeValue = new ProductUpgradeValues($this->dependencyInjector, null);
        $data = $upgradeValue->getAll(["upgradeid" => $this->getValue("id")], true);

        $return = [];

        foreach ($data as $entry){
            $return[$entry["data"]] = $entry;
        }

        return $return;
    }

    public function getUpgradeValue($data)
    {
        $productUpgradeValue = new ProductUpgradeValues($this->dependencyInjector, null);
        $productUpgradeValue = $productUpgradeValue->getAll(["upgradeid" => $this->getValue("id"), "data" => $data]);

        
        return $productUpgradeValue[0];
    }
}