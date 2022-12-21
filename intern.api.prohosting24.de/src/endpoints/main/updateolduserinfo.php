<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["username", "firstname", "lastname"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["username" => $_POST["username"], "firstname" => $_POST["firstname"], "lastname" => $_POST["lastname"], "userid" => $user->getId()], "updateolduserinfo");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
