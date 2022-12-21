<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "accessrights", "productId", "accessId"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["id"], "productId" => $_POST["productId"]], "getServiceOwnerByServiceId");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, "Nicht Ihr Service");
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["userid" => $user->getID(),"id" => $_POST["id"], "productId" => $_POST["productId"], "accessrights" => $_POST["accessrights"], "accessId" => $_POST["accessId"]], "saveAccessRequest");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}