<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["packageid", "imageid", "days"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
if (!isset($_POST["discountcode"])) {
    $_POST["discountcode"] = "";
}

$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid(), "packageid" => $_POST["packageid"], "days" => $_POST["days"], "imageid" => $_POST["imageid"], "discountcode" => $_POST["discountcode"]], "orderpackage");


if(!isset($apirespond)){
    
    $response->setfail(true, "Error");
    print_r(json_encode($response->getresponsearray()));
    die();
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
