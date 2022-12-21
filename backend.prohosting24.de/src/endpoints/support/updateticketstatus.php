<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["ticketid", "status"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$ticket = new Ticket();
$ticket->load_id($masterdatabase, $_POST["ticketid"]);


$ticket->setStatus($_POST["status"]);
$ticket->save($masterdatabase);
