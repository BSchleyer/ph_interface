<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getAccessUserOwner");
if ($ownerid["response"] != $user->getID()) {
    
    $ownerid = requestBackend($config, ["id" => $_POST["id"]], "getAccessUserTarget");
    if ($ownerid["response"] != $user->getID()) {
        $response->setfail(true, "Nicht Ihre Freigabe");
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "getAccessUserRights");

$response->setresponse($apirespond["response"]);