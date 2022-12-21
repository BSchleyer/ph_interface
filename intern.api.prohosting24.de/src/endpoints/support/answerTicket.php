<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid", "text"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ticketid = explode("_",$_POST["ticketid"]);

if(!isset($ticketid[1])){
    $ticketid = $_POST["ticketid"];
} else {
    $ticketid = $ticketid[1];
}


$ticketinfo = requestBackend($config, ["ticketid" => $ticketid, "admin" => 0], "getticketdetails");
if ($ticketinfo["response"][0]["userid"] != $user->getID()) {
    
    $response->setfail(true, $lang->getString("ticketerrornotowner"));
    return;
}


$apirespond = requestBackend($config, ["userid" => $user->getID(), "ticketid" => $ticketid, "text" => $_POST["text"], "extern" => 1, "status" => 1, "mitarbeiter" => 0], "answerticket");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
