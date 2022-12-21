<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "sortid", "cores", "memory", "disk", "price", "title", "description"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(41)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, [
    "id" => $_POST["id"],
    "sortid" => $_POST["sortid"],
    "cores" => $_POST["cores"],
    "memory" => $_POST["memory"],
    "disk" => $_POST["disk"],
    "price" => $_POST["price"],
    "title" => $_POST["title"],
    "description" => $_POST["description"],
], "editpacket");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
