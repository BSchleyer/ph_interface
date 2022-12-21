<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "pteroGetOwner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("apperrornotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["id" => $_POST["id"]], "pteroGetBackups");

$response->setresponse($apirespond["response"]);