<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["name","groupid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, ["name" => $_POST["name"],"groupid" => $_POST["groupid"], "userid" => $user->getID()], "editgroup");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
