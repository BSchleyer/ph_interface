<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class InvoiceInfo extends BaseDatabase
{
	public function __construct($dependencyInjector, $value, $key = "id")
	{
		parent::__construct("main_invoice_info", $dependencyInjector, $value, $key);
	}
}
