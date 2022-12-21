<?php

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$vserver = New VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);

$backuparray = $vserver->getbackupsidnoload();
$backupcount = count($backuparray);
if($vserver->getBackupslots() < $backupcount){
    $response->setfail(200, "Alle Backupslots in nutzung.");
    return;
}



$queue = new VServerQueue($dependencyInjector, null);
$queue->setValue("serviceid", $_POST["id"]);
$queue->setValue("action", 9);
$queue->create();

$response->setresponse("");
