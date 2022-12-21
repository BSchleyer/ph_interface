<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["status", "userid", "admin"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$ticket = new Ticket();
$tickets = $ticket->gettickets($masterdatabase, $_POST["status"], $_POST["userid"], $_POST["admin"]);
foreach ($tickets as $ticketid => $ticket) {
    $tickets[$ticketid]["title"] = htmlspecialchars($tickets[$ticketid]["title"]);
    $tickets[$ticketid]["last_answer"] = niceDate($tickets[$ticketid]["last_answer"]);
    $tickets[$ticketid]["created_on"] = niceDate($tickets[$ticketid]["created_on"]);
}
$response->setresponse($tickets);
