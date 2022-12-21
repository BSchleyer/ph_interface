<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["amount"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$result = requestBackend($config, ["amount" => $_POST["amount"], "userid" => $user->getId()], "orderCoupon");


if (isset($result["error"])) {
    
    $response->setfail(true, $result["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}