<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "token"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getts3owner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("ts3errornotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}
$apirespond = requestBackend($config, ["id" => $_POST["id"], "token" => urlencode($_POST["token"])], "deletets3key");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
