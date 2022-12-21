<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "getts3info");
if ($apirespond["response"]["userid"] != $user->getID()) {
    $response->setfail(true, $lang->getString("ts3errornotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
