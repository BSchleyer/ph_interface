<?php


class VServerNode extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_nodes", $dependencyInjector, $value, $key);
    }
}