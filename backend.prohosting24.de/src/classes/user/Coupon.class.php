<?php


class Coupon extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("coupon_list", $dependencyInjector, $value, $key);
    }
}