<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$result = requestBackend($config, ["id" => $_POST["id"]], "getDonationLinkById");


if(isset($result["error"])){
    $response->setfail(true, $result["error"]);
    return;
}

if($result["response"]["userid"] != $user->getId()){
    $response->setfail(true, $lang->getString("donationlinknotowner"));
    return;
}

$result = requestBackend($config, ["id" => $_POST["id"]], "deleteDonationLink");

if(isset($result["error"])){
    $response->setfail(true, $result["error"]);
    return;
}