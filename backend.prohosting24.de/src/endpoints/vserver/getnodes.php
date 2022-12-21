<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$nodes = New Node($dependencyInjector);
$nodes = $nodes->getall($masterdatabase);

$response->setresponse($nodes);
