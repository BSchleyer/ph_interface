<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "command"])) {
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
    if(!isset($accessUser["response"]["rights"][29])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}
$apirespond = requestBackend($config, ["id" => $_POST["id"], "command" => $_POST["command"]], "vserverexec");
if($apirespond["fail"]){
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
