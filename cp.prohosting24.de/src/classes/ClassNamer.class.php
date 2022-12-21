<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

class ClassNamer
{
    private $classes = [];

    public function getclassname($name)
    {
        if (!isset($this->classes[$name])) {
            $this->classes[$name] = random_str(20, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        }
        return $this->classes[$name];
    }

}
