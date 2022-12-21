<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["internid", "name", "icon"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(15)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["internid" => $_POST["internid"], "name" => $_POST["name"], "icon" => $_POST["icon"]], "createimage");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
