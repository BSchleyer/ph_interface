<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "groupname"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getts3owner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("ts3errornotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}
$apirespond = requestBackend($config, ["id" => $_POST["id"], "groupname" => $_POST["groupname"]], "ts3createtoken");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
