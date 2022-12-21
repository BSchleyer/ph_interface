<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class OldBaseDatabase extends Base
{
	public $tableName = "";

	public function __construct($dependencyInjector, $tableName)
	{
		$this->tableName = $tableName;
		parent::__construct($dependencyInjector);
	}
}
