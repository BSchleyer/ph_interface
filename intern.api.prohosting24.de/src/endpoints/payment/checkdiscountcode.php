<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["code", "productid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["code" => $_POST["code"], "productid" => $_POST["productid"]], "checkdiscountcode");

if (isset($apirespond["error"])) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
