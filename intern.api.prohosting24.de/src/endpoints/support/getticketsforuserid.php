<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!$user->checkright(3)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}


$apirespond = requestBackend($config, ["status" => "", "admin" => 0, "userid" => $_POST["userid"]], "gettickets");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
