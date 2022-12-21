<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class LanguageString extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("lang_strings", $dependencyInjector, $value, $key);
    }
}
