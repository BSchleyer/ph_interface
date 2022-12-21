<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "ip", "target"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["id"],"productid" => 1, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    if(!isset($accessUser["response"]["rights"][6])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "getvserveripadressen");
$ipfound = false;
foreach ($apirespond["response"]["array"] as $ip) {
    if ($ip["ip"] == $_POST["ip"]) {
        $ipfound = true;
    }
}
if (!$ipfound) {
    $response->setfail(true, $lang->getString("ipnotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["ip" => $_POST["ip"], "target" => $_POST["target"]], "addrdns");