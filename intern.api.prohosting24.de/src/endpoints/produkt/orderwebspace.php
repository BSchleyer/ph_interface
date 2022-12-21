<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["disk", "domain", "days"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
if (!isset($_POST["discountcode"])) {
    $_POST["discountcode"] = "";
}

$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid(), "disk" => $_POST["disk"], "domain" => $_POST["domain"], "days" => $_POST["days"], "discountcode" => $_POST["discountcode"]], "orderwebspace");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
