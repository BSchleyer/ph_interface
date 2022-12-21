<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "minute", "hour", "day_month", "month", "day_week", "action", "name"])) {
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
    if(!isset($accessUser["response"]["rights"][33])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

if($_POST["action"] == "command"){
    if (!checkpost($_POST, ["command"])) {
        $response->setfail(true, $lang->getString("missingpostvariable"));
        return;
    }
    $apirespond = requestBackend($config, ["vserverid" => $_POST["id"],"minute"=> $_POST["minute"], "hour"=> $_POST["hour"], "day_month"=> $_POST["day_month"], "month"=> $_POST["month"], "day_week"=> $_POST["day_week"], "action"=> $_POST["action"], "name"=> $_POST["name"], "command" => $_POST["command"]], "vservercroncreate");
} else {
    $apirespond = requestBackend($config, ["vserverid" => $_POST["id"],"minute"=> $_POST["minute"], "hour"=> $_POST["hour"], "day_month"=> $_POST["day_month"], "month"=> $_POST["month"], "day_week"=> $_POST["day_week"], "action"=> $_POST["action"], "name"=> $_POST["name"]], "vservercroncreate");
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}