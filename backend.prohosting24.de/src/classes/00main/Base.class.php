<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Base
{
	protected DependencyInjector $dependencyInjector;

	public function __construct($dependencyInjector)
	{
		$this->dependencyInjector = $dependencyInjector;
	}

}