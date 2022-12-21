<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid", "text", "extern"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!$user->checkright(33)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}


$apirespond = requestBackend($config, ["userid" => $user->getID(), "ticketid" => $_POST["ticketid"], "text" => $_POST["text"], "extern" => $_POST["extern"], "status" => 2, "mitarbeiter" => 1], "answerticket");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
