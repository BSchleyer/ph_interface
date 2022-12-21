<?php


class UserNew extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user", $dependencyInjector, $value, $key);
    }
}
