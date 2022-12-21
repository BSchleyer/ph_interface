<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "getvserverinfos");

if(!isset($apirespond["response"]["userid"])){
    $response->setfail(true, $lang->getString("error"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

if ($apirespond["response"]["userid"] != $user->getID()) {
    if(!in_array($user->getID(), $apirespond["response"]["accessUsers"])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
