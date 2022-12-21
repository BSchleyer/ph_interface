<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["domain", "kontaktid", "authCode"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, [
    "sessionid" => $user->getSessionid(),
    "domain" => $_POST["domain"],
    "kontaktid" => $_POST["kontaktid"],
    "ns1" => "ns1.prohosting24.de",
    "ns2" => "ns2.prohosting24.eu",
    "ns3" => "ns1.prohosting24.eu",
    "ns4" => "ns2.prohosting24.de",
    "ns5" => "0",
    "authCode" => $_POST["authCode"]
], "oderdomain");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
