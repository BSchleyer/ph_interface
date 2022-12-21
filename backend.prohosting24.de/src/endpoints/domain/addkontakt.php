<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$domain = new Domain($masterdatabase, $config);

if (!checkpost($_POST, ["userid", "sex", "firstname", "lastname", "street", "number", "postcode", "city", "region", "country", "phone", "email"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
try {
    $res = $domain->addkontakt($_POST["userid"], [
        "type" => "PERS",
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
    ]);
    $response->setresponse($res);
}catch (Exception $e){
    $response->setfail(true, "Beim Erstellen ist ein Fehler aufgetreten, bitte wenden Sie sich an den Support.");
}