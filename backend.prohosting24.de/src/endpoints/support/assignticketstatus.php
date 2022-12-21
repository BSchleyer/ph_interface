<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["ticketid", "userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$ticket = new Ticket();
$ticket->load_id($masterdatabase, $_POST["ticketid"]);


$ticket->setAdmin($_POST["userid"]);
$ticket->setStatus(5);
$ticket->save($masterdatabase);
