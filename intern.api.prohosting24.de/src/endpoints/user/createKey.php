<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["key"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["userid" => $user->getID(), "key" => $_POST["key"]], "userSettingCreateKey");

if ($apirespond["fail"] == 500) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}


