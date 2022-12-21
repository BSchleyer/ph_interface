<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class AffiliatePayout extends BaseDatabase
{
	public function __construct($dependencyInjector, $value, $key = "id")
	{
		parent::__construct("affiliate_payout", $dependencyInjector, $value, $key);
	}
}
