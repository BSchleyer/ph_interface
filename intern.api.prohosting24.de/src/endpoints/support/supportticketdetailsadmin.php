<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
if (!$user->checkright(33)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$ticketinfo = requestBackend($config, ["ticketid" => $_POST["ticketid"], "admin" => 1], "getticketdetails");
$response->setresponse($ticketinfo["response"]);
