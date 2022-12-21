<?php


class Syslog extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_syslog", $dependencyInjector, $value, $key);
    }

    public function log($type, $data)
    {
        $this->setValue("type", $type);
        $this->setValue("data", json_encode($data));
        $this->create();
    }
}