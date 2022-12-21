<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["name", "hostname", "ip", "username", "password"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(12)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["name" => $_POST["name"],"hostname" => $_POST["hostname"],"ip" => $_POST["ip"],"username" => $_POST["username"],"password" => $_POST["password"]], "createnode");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
