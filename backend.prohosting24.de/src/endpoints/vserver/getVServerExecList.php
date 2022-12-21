<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vserver = new VServer($dependencyInjector);

$vserver->loadwithid($_POST["id"]);

$currentData = $vserver->getcurrent();

if(!isset($currentData["data"]["status"]) && $currentData["data"]["status"] != "running"){
    $response->setresponse([]);
    return;
}

if(!isset($currentData["data"]["uptime"])){
    $response->setresponse([]);
    return;
}

$time = time() - $currentData["data"]["uptime"];

$execList = new VserverExecList($dependencyInjector, null);

$data = $execList->getAll(["vserverid" => $_POST["id"], "created_on[>]" => date("Y-m-d H:i:s", $time)], true);

$returnData = [];

foreach ($data as $entry){
    $returnData[] = [
        "pid" => $entry["pid"],
        "command" => $entry["command"],
        "created_on" => niceDate($entry["created_on"]),
    ];
}

$response->setresponse($returnData);
