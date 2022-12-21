<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["slots", "days"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!isset($_POST["discountcode"])) {
    $_POST["discountcode"] = "";
}

$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid(), "slots" => $_POST["slots"], "discountcode" => $_POST["discountcode"], "days" => $_POST["days"]], "oderteamspeak");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
