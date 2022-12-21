<?php


class VServerCron extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_crons", $dependencyInjector, $value, $key);
    }

    public function log($langTag)
    {
        $log = new VServerCronLog($this->dependencyInjector, null);
        $log->setValue("cronid", $this->getValue("id"));
        $log->setValue("lang", $langTag);
        $log->create();
    }
}