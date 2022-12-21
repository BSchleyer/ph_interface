<?php

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$vserver = New VServer($dependencyInjector);

$backups = $vserver->getbackupsid($_POST["id"]);

$response->setresponse($backups);
