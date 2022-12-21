<?php


class VServerQueueTask extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_queue_tasks", $dependencyInjector, $value, $key);
    }
}