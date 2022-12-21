<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["netzid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(18)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["netzid" => $_POST["netzid"]], "addsubnet");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
