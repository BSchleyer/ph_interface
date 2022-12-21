<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!$user->checkright(45)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, [], "getlostdomains");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
