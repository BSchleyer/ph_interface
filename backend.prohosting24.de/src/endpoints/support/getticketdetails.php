<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["ticketid", "admin"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

if(strpos($_POST["ticketid"], "ticket_") !== false){
    $_POST["ticketid"] = str_replace("ticket_", "", $_POST["ticketid"]);
}
if ($_POST["admin"] == 1) {
    $extern = [0, 1];
} else {
    $extern = 1;
}

$ticket = new Ticket();
$ticketdetails = $ticket->getticketdetails($masterdatabase, $_POST["ticketid"], $extern, $dependencyInjector);

$response->setresponse($ticketdetails);
