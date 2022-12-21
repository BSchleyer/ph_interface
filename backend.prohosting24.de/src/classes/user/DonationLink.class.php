<?php


class DonationLink extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("donate_links", $dependencyInjector, $value, $key);
    }
}