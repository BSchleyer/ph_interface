<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "ns1", "ns2", "ns3", "ns4", "ns5"])) {
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
    if(!isset($accessUser["response"]["rights"][26])){
        $response->setfail(true, $lang->getString("domainerrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"], "ns1" => $_POST["ns1"], "ns2" => $_POST["ns2"], "ns3" => $_POST["ns3"], "ns4" => $_POST["ns4"], "ns5" => $_POST["ns5"]], "changenameserver");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
