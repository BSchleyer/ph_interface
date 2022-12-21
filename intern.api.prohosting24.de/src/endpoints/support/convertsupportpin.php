<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["pin"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!$user->checkright(1)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}



$apirespond = requestBackend($config, ["pin" => $_POST["pin"]], "convertsupportpin");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
