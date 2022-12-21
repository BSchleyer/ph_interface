<?php

defined('RZGvsletoIujWnzKrNyB') or die();

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

    public function sendclient($name, $response, $config, $user,$lang)
    {
        
        
        require_once 'src/endpoints/' . $this->routes[$name];
    }
}
