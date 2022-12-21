<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["name","displayName"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$result = requestBackend($config, ["name" => $_POST["name"],"displayName" => $_POST["displayName"], "userid" => $user->getId()], "createDonationLink");


if (isset($result["error"])) {
    
    $response->setfail(true, $result["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}