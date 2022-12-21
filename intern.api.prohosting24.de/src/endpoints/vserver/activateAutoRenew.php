<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id", "productId"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["id"], "productId" => $_POST["productId"]], "getServiceOwnerByServiceId");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, "Nicht Ihr Service");
    print_r(json_encode($response->getresponsearray()));
    die();
}


$apirespond = requestBackend($config, ["id" => $_POST["id"], "productId" => $_POST["productId"]], "activateAutoRenew");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
