<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!$user->checkright(33)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}



$apirespond = requestBackend($config, ["ticketid" => $_POST["ticketid"], "status" => 3], "updateticketstatus");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
