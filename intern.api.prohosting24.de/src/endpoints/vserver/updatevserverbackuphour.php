<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "hour"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!is_numeric($_POST["hour"])) {
    $response->setfail(true, $lang->getString("vpserrornotavalidhour"));
    return;
}
if ($_POST["hour"] != 321) {
    if ($_POST["hour"] < 0) {
        $response->setfail(true, $lang->getString("vpserrornotavalidhour"));
        return;
    }
    if ($_POST["hour"] > 23) {
        $response->setfail(true, $lang->getString("vpserrornotavalidhour"));
        return;
    }
}

$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["id"],"productid" => 1, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    if(!isset($accessUser["response"]["rights"][13])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"], "hour" => $_POST["hour"]], "updatevserverbackuphour");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
