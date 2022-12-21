<?php

defined('RZGvsletoIujWnzKrNyB') or die();
$apirespond = [];
$apirespond["email"] = $user->getEmail();
$apirespond["username"] = $user->getUsername();
$apirespond["id"] = $user->getId();
$apirespond["vorname"] = $user->getVorname();
$apirespond["nachname"] = $user->getNachname();
$apirespond["guthaben"] = $user->getGuthaben();

$response->setresponse($apirespond);
