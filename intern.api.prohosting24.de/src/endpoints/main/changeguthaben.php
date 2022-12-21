<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["userid", "change", "reason"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


if (!$user->checkright(3)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["userid" => $_POST["userid"], "change" => $_POST["change"], "reason" => $_POST["reason"]], "changeguthaben");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
