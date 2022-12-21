<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["amount", "method", "invoice", "closeSuccess"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$data = ["userid" => $user->getID(), "amount" => $_POST["amount"], "closeSuccess" => $_POST["closeSuccess"],"method" => $_POST["method"], "invoice" => $_POST["invoice"]];

if(isset($_POST["donationLink"])){
    $data["donationLink"] = $_POST["donationLink"];
}

$apirespond = requestBackend($config, $data, "paymentstart");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
