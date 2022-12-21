<?php


class DomainList extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("domain_list", $dependencyInjector, $value, $key);
    }
}