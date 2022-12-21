<?php


class SevdeskCountrys extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_sevdesk_countrys", $dependencyInjector, $value, $key);
    }
}