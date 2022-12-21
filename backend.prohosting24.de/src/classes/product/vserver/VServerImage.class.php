<?php


class VServerImage extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_images", $dependencyInjector, $value, $key);
    }
}