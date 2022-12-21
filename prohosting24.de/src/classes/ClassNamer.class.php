<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

class ClassNamer
{
    private $classes = [];

    public function __construct()
    {
    }

    public function getclassname($name)
    {
        if (!isset($this->classes[$name])) {
            $this->classes[$name] = random_str(20, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        }
        return $this->classes[$name];
    }

}
