<?php


class VServerQueueData extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_queue_data", $dependencyInjector, $value, $key);
    }
}