<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["id", "sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$user = new User();
$user->load_sessionid($dependencyInjector->getDatabase(), $_POST["sessionid"]);

$vserver = $dependencyInjector->getDatabase()->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.userid",
    "service_main.id",
], [
    "vserver_main.id" => $_POST["id"],
    "service_main.produktid" => 1,
]);

if(count($vserver) != 1){
    $response->setfail(true, "Missing Auth");
    return;
}

if($vserver[0]["userid"] != $user->getID()){
    $access = new AccessUser($dependencyInjector, null);
    $access = $access->getAll(["userid" => $_POST["userid"], "serviceid" => $vserver[0]["id"],"status" => 1]);
    if(count($access) != 1){
        $response->setfail(true, "Missing Auth");
        return;
    }
    $access = $access[0];
    if(!isset($access->getRightList()[7])){
        $response->setfail(true, "Missing Auth");
        return;
    }
}

$vserver = new VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);

$vncdata = $vserver->getVNCData();


$response->setresponse($vncdata);