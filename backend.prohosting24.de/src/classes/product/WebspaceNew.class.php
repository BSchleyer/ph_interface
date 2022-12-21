<?php


class WebspaceNew extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("webspace_main", $dependencyInjector, $value, $key);
    }
}