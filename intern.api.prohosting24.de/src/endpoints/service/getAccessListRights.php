<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["productId"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$apirespond = requestBackend($config, ["productId" => $_POST["productId"]], "getAccessListRights");

$response->setresponse($apirespond["response"]);