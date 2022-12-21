<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class PteroPorts extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_products_ports", $dependencyInjector, $value, $key);
    }

    public function getPorts($productid)
    {
        $returnPorts = [];
        $ports = $this->getAll(["productid" => $productid]);
        foreach ($ports as $port){
            $returnPorts[]  = strval($port->getValue("port"));
        }
        return $returnPorts;
    }

}