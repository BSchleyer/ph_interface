<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class LanguageValue extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("lang_values", $dependencyInjector, $value, $key);
    }
}
