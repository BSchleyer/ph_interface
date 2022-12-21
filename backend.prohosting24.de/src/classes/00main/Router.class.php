<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Router
{
    private $routes = [];
    private $newRoutes = [];
    private $subdir;
    private $newSubDir = "src/routes/";

    public function __construct($subdir)
    {
        $this->subdir = $subdir;
	}

	public function addroute($name, $target, $new = false,$newData = [])
	{
	    if(!$new){
            $this->routes[$name] = $target;
        } else {
            $this->newRoutes[$name] = $newData;
        }
	}

	public function checkroute($name)
	{
		if (isset($this->routes[$name])) {
			return true;
		} else {
            if (isset($this->newRoutes[$name])) {
                return true;
            }
		}
        return false;
	}

	public function sendclient($name, $response, $config, $masterdatabase, $dependencyInjector)
	{
		
		if (!isset($this->routes[$name])) {
            if (!isset($this->newRoutes[$name])) {
                throw new Exception('Route existiert nicht');
            } else {
                $data = $this->newRoutes[$name];
                require_once $this->newSubDir . $data[0];
                $target = new $data[1]($dependencyInjector);
                return call_user_func_array([$target, $data[2]], []);
            }
		} else {
            require_once $this->subdir . $this->routes[$name];
        }
	}
}
