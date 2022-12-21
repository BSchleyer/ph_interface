<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "pteroGetOwner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["id"],"productid" => 5, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("apperrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    if(!isset($accessUser["response"]["rights"][24])){
        $response->setfail(true, $lang->getString("apperrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "pteroGetSFTP");

$response->setresponse($apirespond["response"]);