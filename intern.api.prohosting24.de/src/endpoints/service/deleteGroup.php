<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["groupid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["groupid"]], "getgroupowner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("groupnotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["id" => $_POST["groupid"]], "deleteGroup");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
