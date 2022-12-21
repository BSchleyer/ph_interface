<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}
$vserver = new \Ph24\service\VServer($dependencyInjector, $_POST["id"], "childid");

$vserver->start();

if($dependencyInjector->isFail()){
    $response->setfail(true, $dependencyInjector->getMessage());
    return;
}
