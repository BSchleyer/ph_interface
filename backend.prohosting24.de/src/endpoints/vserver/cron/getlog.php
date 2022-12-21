<?php


if (!checkpost($_POST, ["cronid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$cronLog = new VServerCronLog($dependencyInjector, null);

$cronLogs = $cronLog->getAll(["cronid" => $_POST["cronid"]], true);

$return = [];

foreach ($cronLogs as $log){
    $return[] = [
        "id" => $log["id"],
        "info" => $dependencyInjector->getLang()->getString($log["lang"]),
        "created_on" => niceDate($log["created_on"]),
    ];
}

$response->setresponse($return);