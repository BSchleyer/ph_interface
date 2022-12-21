<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["targetuserid", "serviceid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(3)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["targetuserid" => $_POST["targetuserid"], "serviceid" => $_POST["serviceid"]], "transferservice");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
