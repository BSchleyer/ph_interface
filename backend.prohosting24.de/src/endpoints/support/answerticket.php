<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "ticketid", "text", "extern", "status", "mitarbeiter"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$ratelimit = new RateLimit($masterdatabase);
if ($ratelimit->check("ticketAnswer",  $_POST["userid"], null)) {
    $response->setfail(true, "...");
    return;
}

if (!strlen(str_replace(' ', '', $_POST["text"])) > 0) {
    $response->setfail(true, "Bitte gebe einen Text ein");
    return;
}
$_POST["text"] = strip_unsafe($_POST["text"]);
$ticket = new Ticket();
$ticket->load_id($masterdatabase, $_POST["ticketid"]);
$ratelimit->add("ticketAnswer", $_POST["userid"], null, 10, "30 Minutes");


$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);

$ticket->addanswer($masterdatabase, $_POST["text"], $_POST["userid"], $_POST["status"], $_POST["extern"], $_POST["mitarbeiter"], $config);
sendtodc('Neue Ticket Antwort.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
TicketId: ' . $_POST["ticketid"] . '
Link: https://prohosting24.de/admin/support/ticket/' . $_POST["ticketid"], $config);
$response->setresponse("Erfolgreich auf das Ticket geantwortet.");
