<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$ticketinfo = requestBackend($config, ["ticketid" => $_POST["ticketid"], "admin" => 0], "getticketdetails");
if ($ticketinfo["response"][0]["userid"] != $user->getID()) {
    
    $response->setfail(true, $lang->getString("ticketerrornotowner"));
    return;
}
$response->setresponse($ticketinfo["response"]);
