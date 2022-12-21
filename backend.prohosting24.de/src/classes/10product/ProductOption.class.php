<?php


namespace PH24\product;

use BaseDatabase;

class ProductOption extends BaseDatabase
{
    private ProductOptionType $type;

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("product_option", $dependencyInjector, $value, $key);
    }

    public function getType(): ProductOptionType
    {
        if(isset($this->type)) return $this->type;
        $this->type = new ProductOptionType($this->dependencyInjector, $this->getValue("typeid"));
        return $this->type;
    }

    public function getOptionValue($value)
    {
        switch ($this->getType()->getValue("type")){
            case 'select':
                $optionValue = new ProductOptionValue($this->dependencyInjector, null);
                
                return $optionValue->getAll(["optionid" => $this->getValue("id"), "key" => $value])[0];
            case 'input':
            case 'textbox':
                return null;
            default:
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                break;
        }
    }

    public function validate($data)
    {
        switch ($this->getType()->getValue("type")){
            case 'select':
                $values = $this->getValues();
                if(!isset($values[$data])){
                    $this->dependencyInjector->setResponseCode(400);
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                    $this->dependencyInjector->setFail(true);
                }
                break;
            case 'input':
            case 'textbox':
                break;
            default:
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                break;
        }
    }

    public function getValues()
    {
        $optionValue = new ProductOptionValue($this->dependencyInjector, null);
        $optionValues = $optionValue->getAll(["optionid" => $this->getValue("id")]);
        $return = [];
        foreach ($optionValues as $value){
            $return[$value->getValue("key")] = $value;
        }
        return $return;
    }

    public function getData()
    {
        $return = [
            "type" => $this->getType()->getValue("type"),
        ];

        switch ($this->getType()->getValue("type")){
            case 'select':
                $return["values"] = $this->getValues();
                return $return;
            case 'input':
                return $return;
            default:
                $this->dependencyInjector->setResponseCode(400);
                $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("invalidConfig"));
                $this->dependencyInjector->setFail(true);
                return $this->dependencyInjector;
        }

    }
}