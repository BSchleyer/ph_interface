<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "paymentid", "payer", "method"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

if($_POST["method"] == "stripecheckout"){
    $response->setresponse("");
    return;
}
$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);

$payment = new Payment($config, $dependencyInjector);

$response->setresponse($payment->finish($_POST["method"], $masterdatabase, ["id" => $_POST["paymentid"], "payer" => $_POST["payer"]], $user,$dependencyInjector));
