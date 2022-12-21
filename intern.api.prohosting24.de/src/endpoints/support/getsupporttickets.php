<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!$user->checkright(33)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}


$apirespond = requestBackend($config, ["status" => "", "admin" => 1, "userid" => $user->getID()], "gettickets");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
