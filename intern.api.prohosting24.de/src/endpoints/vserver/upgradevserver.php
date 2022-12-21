<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["cores", "memory", "disk", "id", "slots", "calculate"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("vservernotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["userid" => $user->getID(), "vserverid" => $_POST["id"], "cores" => $_POST["cores"], "memory" => $_POST["memory"], "disk" => $_POST["disk"], "slots" => $_POST["slots"], "calculate" => $_POST["calculate"]], "upgradevserver");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
