<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["type", "data", "count", "code"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!$user->checkright(47)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["type" => $_POST["type"], "data" => $_POST["data"], "count" => $_POST["count"], "code" => $_POST["code"]], "creatediscount");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
