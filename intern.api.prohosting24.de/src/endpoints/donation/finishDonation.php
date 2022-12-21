<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["paymentid", "token","payer","type","reason"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$data = ["paymentid" => $_POST["paymentid"],"token" => $_POST["token"],"payer" => $_POST["payer"], "type" => $_POST["type"], "reason" => $_POST["reason"]];
$result = requestBackend($config, $data, "finishDonation");
if(isset($result["error"])){
    $response->setfail(true, $result["error"]);
    return;
}
