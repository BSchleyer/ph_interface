<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "name", "title", "data", "date_nohtml"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}



if (!$user->checkright(37)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["id" => $_POST["id"], "name" => $_POST["name"], "title" => $_POST["title"], "data" => $_POST["data"], "date_nohtml" => $_POST["date_nohtml"]], "updatetemplate");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
