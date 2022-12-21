<?php


class VserverExecList extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_exec_list", $dependencyInjector, $value, $key);
    }
}