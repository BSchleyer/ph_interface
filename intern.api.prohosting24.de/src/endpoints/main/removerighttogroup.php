<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["rightid", "groupid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(11)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["rightid" => $_POST["rightid"], "groupid" => $_POST["groupid"]], "removerighttogroup");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
