<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["serviceid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(3)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["serviceid" => $_POST["serviceid"]], "stornoservice");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
