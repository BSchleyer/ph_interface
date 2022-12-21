<?php


namespace Ph24\service;

use BaseDatabase;
use Functions;

class VServerPacket extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_packets", $dependencyInjector, $value, $key);
    }

    public function getData()
    {
        return Functions::removeData($this->fields,["created_on","normal"]);
    }
}