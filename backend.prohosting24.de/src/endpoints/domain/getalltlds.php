<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$domain = new Domain($masterdatabase, $config);

$res = $domain->getalldomainsc();
$response->setresponse($res);
