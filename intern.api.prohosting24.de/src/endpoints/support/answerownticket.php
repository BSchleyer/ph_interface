<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid", "text"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$ticketinfo = requestBackend($config, ["ticketid" => $_POST["ticketid"], "admin" => 0], "getticketdetails");
if ($ticketinfo["response"][0]["userid"] != $user->getID()) {
    
    $response->setfail(true, $lang->getString("ticketerrornotowner"));
    return;
}


$apirespond = requestBackend($config, ["userid" => $user->getID(), "ticketid" => $_POST["ticketid"], "text" => $_POST["text"], "extern" => 1, "status" => 1, "mitarbeiter" => 0], "answerticket");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
