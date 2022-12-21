<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["webspaceid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["webspaceid"]], "getwebspaceowner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["webspaceid"],"productid" => 2, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("webspacenotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}


$apirespond = requestBackend($config, ["userid" => $user->getId(), "webspaceid" => $_POST["webspaceid"]], "getdomainlist");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$response->setresponse($apirespond["response"]);
