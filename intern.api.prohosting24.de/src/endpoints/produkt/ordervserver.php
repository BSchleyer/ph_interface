<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["cores", "memory", "disk", "ip", "imageid", "days"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
if (!isset($_POST["discountcode"])) {
    $_POST["discountcode"] = "";
}

$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid(), "cores" => $_POST["cores"], "memory" => $_POST["memory"], "disk" => $_POST["disk"], "ip" => $_POST["ip"], "imageid" => $_POST["imageid"], "discountcode" => $_POST["discountcode"], "days" => $_POST["days"]] , "ordervserver");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
