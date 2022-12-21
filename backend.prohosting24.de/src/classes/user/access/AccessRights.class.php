<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class AccessRights extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("access_rights", $dependencyInjector, $value, $key);
    }
}
