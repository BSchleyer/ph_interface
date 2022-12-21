<?php


namespace PH24\product;

use BaseDatabase;

class ProductAddon extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_addon", $dependencyInjector, $value, $key);
    }

    public function validate($count)
    {
        $mincount = $this->getValue("freecount");
        if($mincount == 0){
            $mincount = 1;
        }

        if(!is_int($count) || $count < $mincount || $count > $this->getValue('maxcount')){
            $this->dependencyInjector->setResponseCode(400);
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
            $this->dependencyInjector->setFail(true);
            return $this->dependencyInjector;
        }
    }

    public function getPriceRaw($count)
    {
        return $this->getValue('price') * ($count - $this->getValue("freecount"));
    }
}