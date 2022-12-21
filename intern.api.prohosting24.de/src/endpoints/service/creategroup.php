<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, ["name" => $_POST["name"], "userid" => $user->getID()], "creategroup");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
