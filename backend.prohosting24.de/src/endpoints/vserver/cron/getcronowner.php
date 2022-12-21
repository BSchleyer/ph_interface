<?php


if (!checkpost($_POST, ["cronid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$cronLog = new VServerCron($dependencyInjector, null);
$cronLog = $cronLog->getAll(["id" => $_POST["cronid"]]);

if(count($cronLog) != 1){
    $response->setresponse(0);
    return;
}

$cronLog = $cronLog[0];

$vserver = new \Ph24\service\VServer($dependencyInjector, $cronLog->getValue("vserverid"), "childid");


$response->setresponse($vserver->getValue("userid"));