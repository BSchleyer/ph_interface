<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

class Router
{
    private $routes = [];
    public function __construct()
    {
        return true;
    }

    public function addroute($name, $target)
    {
        

        $this->routes[$name] = $target;
    }
    public function checkroute($name)
    {
        if (isset($this->routes[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public function sendclient($name, $router, $config, $content, $user)
    {
        
        
        require_once 'src/pages/' . $this->routes[$name];
    }
}
