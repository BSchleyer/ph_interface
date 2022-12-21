<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["action", "link", "data"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$apirespond = requestBackend($config, ["action" => $_POST["action"], "link" => $_POST["link"], "data" => $_POST["data"]], "linkresolve");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
