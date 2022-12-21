<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class ProxmoxUser extends BaseDatabase
{
	public function __construct($dependencyInjector, $value, $key = "id")
	{
		parent::__construct("vserver_proxmoxuser", $dependencyInjector, $value, $key);
    }
    

    public function load($key, $value)
	{
		$data = $this->dependencyInjector->getDatabase()->select($this->tableName, '*', [$key => $value]);
		if (count($data) != 1) {
			return false;
		}
        $this->fields = $data[0];
        return true;
	}
}
