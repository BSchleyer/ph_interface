<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "serviceid", "title", "text"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$ratelimit = new RateLimit($masterdatabase);
if ($ratelimit->check("ticketCreate", $_POST["userid"], null)) {
    $response->setfail(true, "Sie können nur 2 Tickets in der Stunde anlegen.");
    return;
}

if (strlen($_POST["title"]) > 128) {
    $response->setfail(true, "Titel ist länger als 128 Zeichen");
    return;
}

if (!strlen(str_replace(' ', '', $_POST["title"])) > 0) {
    $response->setfail(true, "Bitte gebe einen Titel ein");
    return;
}
if (!strlen(str_replace(' ', '', $_POST["text"])) > 0) {
    $response->setfail(true, "Bitte gebe einen Text ein");
    return;
}
$_POST["text"] = strip_unsafe($_POST["text"]);
$_POST["title"] = htmlspecialchars($_POST["title"]);
$ticket = new Ticket();
$ticket->setTitle($_POST["title"]);
$ticket->setServiceid($_POST["serviceid"]);
$ticket->setUserid($_POST["userid"]);
$ticket->create($masterdatabase);

$ratelimit->add("ticketCreate", $_POST["userid"], null, 2, "1 hour");


$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);
$ticket->addanswer($masterdatabase, $_POST["text"], $_POST["userid"], 0, 1, 0, $config, true);
sendtodc('Neues Ticket.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
TicketId: ' . $ticket->getId() . '
Titel: ' . $_POST["title"] . '
Link: https://prohosting24.de/admin/support/ticket/' . $ticket->getId(), $config);
$response->setresponse($ticket->getId());
$mail = new Mail($masterdatabase, $config);
$mail->addmail("support_ticket_new", $user->getID(), [
    "name" => $user->getVorname() . " " . $user->getNachname(),
    "title" => $_POST["title"],
    "message" => $_POST["text"],
    "ticketlink" => 'https://prohosting24.de/cp/support/ticket/' . $ticket->getId(),
]);
