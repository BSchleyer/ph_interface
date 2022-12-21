<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "entryType","entryName", "entryContent", "oldName"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getdomainowner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["id"],"productid" => 4, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("domainerrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    if(!isset($accessUser["response"]["rights"][25])){
        $response->setfail(true, $lang->getString("domainerrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"],"entryName" => $_POST["entryName"],"entryType" => $_POST["entryType"],"entryContent" => $_POST["entryContent"],"oldName" => $_POST["oldName"]], "editdnsentry");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
