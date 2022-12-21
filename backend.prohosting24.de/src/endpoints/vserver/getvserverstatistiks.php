<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "time", "art"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$vserver = new VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);
$vminfoarray = $vserver->getstatistiks($_POST["time"], $_POST["art"]);

if(!isset($vminfoarray["data"])){
    $response->setfail(true, "Error");
    return;
}

foreach ($vminfoarray["data"] as $infokey => $info) {
	if (!isset($info["cpu"])) {
		$vminfoarray["data"][$infokey]["cpu"] = 0;
	} else {
		$vminfoarray["data"][$infokey]["cpu"] = $info["cpu"] * 100;
	}
}

$response->setresponse($vminfoarray);
