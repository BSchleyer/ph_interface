<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$vserver = new VServer($dependencyInjector);
$vserversPromox = $vserver->getallvmids();

$vservers = $masterdatabase->select("service_main", [
    "id",
    "produktid",
    "serviceid",
], [
    "delete_done" => 0,
    "produktid" => 1
]);

$vserversds = [];
foreach ($vservers as $vserver) {
	$vserversds[] = $vserver["serviceid"];
}

$outputarray = [];
foreach ($vserversPromox as $vserver) {
    if (!in_array($vserver, $vserversds)) {
        $outputarray[] = $vserver;
    }
}
$response->setresponse($outputarray);
