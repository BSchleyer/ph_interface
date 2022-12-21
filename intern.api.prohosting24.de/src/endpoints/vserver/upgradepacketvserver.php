<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["packetid", "id", "calculate"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("vservernotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["userid" => $user->getID(), "vserverid" => $_POST["id"], "packetid" => $_POST["packetid"], "calculate" => $_POST["calculate"]], "upgradepacketvserver", false);

if(!isset($apirespond)){
    
    $response->setfail(true, "Error");
    print_r(json_encode($response->getresponsearray()));
    die();
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
