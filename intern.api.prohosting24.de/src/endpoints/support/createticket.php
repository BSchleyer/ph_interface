<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["text", "title"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}



$apirespond = requestBackend($config, ["text" => $_POST["text"], "title" => $_POST["title"], "userid" => $user->getID(), "serviceid" => 0], "createticket");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}

$response->setresponse(["ticketid" => $apirespond["response"]]);
