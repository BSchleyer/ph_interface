<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["amount", "type","donationLink","reason"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$data = ["amount" => $_POST["amount"],"method" => $_POST["type"],"donationLink" => $_POST["donationLink"], "reason" => $_POST["reason"]];
$result = requestBackend($config, $data, "startDonation");
if(isset($result["error"])){
    $response->setfail(true, $result["error"]);
    return;
}
$response->setresponse($result["response"]);
