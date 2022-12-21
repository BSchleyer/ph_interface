<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["email", "passwort", "vorname", "nachname", "loginemail","newsletter", "lang","darkmode"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, ["userid" => $user->getId(), "email" => $_POST["email"], "newsletter" => $_POST["newsletter"], "passwort" => $_POST["passwort"], "vorname" => $_POST["vorname"], "nachname" => $_POST["nachname"], "loginemail" => $_POST["loginemail"], "lang" => $_POST["lang"], "darkmode" => $_POST["darkmode"]], "edituser");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
