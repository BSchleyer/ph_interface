<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["coupon"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$result = requestBackend($config, ["id" => $_POST["coupon"], "userid" => $user->getId()], "redeemCoupon");


if (isset($result["error"])) {
    
    $response->setfail(true, $result["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}