<?php


class PteroProductsVariables extends BaseDatabase
{
    private $typeName = "";
    private $values = [];

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_variables", $dependencyInjector, $value, $key);
    }

    public function getType()
    {
        $tmp = new PteroProductsVariablesTypes($this->dependencyInjector,$this->getValue("typeid"),"id");
        $this->typeName = $tmp->getValue("type");
        return $this->typeName;
    }

    public function loadValues()
    {
        $tmp = new PteroProductsVariablesValues($this->dependencyInjector,null);
        $this->values = $tmp->getAll(["variableid" => $this->getValue("id")]);
    }

    public function getValues()
    {
        $this->loadValues();
        $return = [];
        foreach ($this->values as $value){
            $tmp = [];
            $tmp["key"] = $value->getValue("key");
            $tmp["value"] = $value->getValue("value");
            $return[] = $tmp;
        }
        return $return;
    }
}
