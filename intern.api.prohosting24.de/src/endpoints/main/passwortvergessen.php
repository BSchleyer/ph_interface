<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["email"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$apirespond = requestBackend($config, ["email" => $_POST["email"], "ip" => getclientip()], "passwortvergessen");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
