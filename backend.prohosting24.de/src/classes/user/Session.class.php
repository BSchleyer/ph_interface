<?php


class Session extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user_sessions", $dependencyInjector, $value, $key);
    }
}