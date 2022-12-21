<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["sex", "firstname", "lastname", "street", "number", "postcode", "city", "region", "country", "phone", "email"], true)) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, [
    "userid" => $user->getId(),
    "sex" => $_POST["sex"],
    "firstname" => $_POST["firstname"],
    "lastname" => $_POST["lastname"],
    "street" => $_POST["street"],
    "number" => $_POST["number"],
    "postcode" => $_POST["postcode"],
    "city" => $_POST["city"],
    "region" => $_POST["region"],
    "country" => $_POST["country"],
    "phone" => $_POST["phone"],
    "email" => $_POST["email"],
], "addkontakt");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
