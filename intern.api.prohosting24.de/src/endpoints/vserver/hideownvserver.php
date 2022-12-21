<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("vservernotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "hidevserver");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
