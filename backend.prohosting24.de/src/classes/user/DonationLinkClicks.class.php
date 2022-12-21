<?php


class DonationLinkClicks extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("donate_link_clicks", $dependencyInjector, $value, $key);
    }
}