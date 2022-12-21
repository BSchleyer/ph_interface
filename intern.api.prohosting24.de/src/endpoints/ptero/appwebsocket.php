<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "pteroGetOwner");
if ($ownerid["response"] != $user->getID()) {
    $apirespond = requestBackend($config, ["id" => $_POST["id"]], "getpteroinfo");
    if(!in_array($user->getID(), $apirespond["response"]["accessUsers"])){
        $response->setfail(true, $lang->getString("apperrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "pteroWebsocket");

$response->setresponse($apirespond["response"]);