<?php


class DiscountValue extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user_discount_value", $dependencyInjector, $value, $key);
    }
}