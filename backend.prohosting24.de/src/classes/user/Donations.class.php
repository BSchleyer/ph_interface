<?php


class Donations extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("donate_link_donations", $dependencyInjector, $value, $key);
    }
}