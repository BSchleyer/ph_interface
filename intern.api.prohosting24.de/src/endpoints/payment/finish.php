<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["paymentid", "token", "payer", "method"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["userid" => $user->getID(), "method" => $_POST["method"], "paymentid" => $_POST["paymentid"], "token" => $_POST["token"], "payer" => $_POST["payer"]], "paymentfinish");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
