<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$result = requestBackend($config, ["link" => $_POST["name"], "id" => $user->getId()], "createlink");


if ($result["fail"] == 200) {
    
    $response->setfail(true, $result["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}