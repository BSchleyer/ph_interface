<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(6)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["name" => $_POST["name"]], "addright");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
