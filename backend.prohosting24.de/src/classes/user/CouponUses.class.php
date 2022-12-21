<?php


class CouponUses extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("coupon_uses", $dependencyInjector, $value, $key);
    }
}