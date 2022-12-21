<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["pin"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$user = $masterdatabase->select("main_user", [
    "id",
], [
    "supportpin" => $_POST["pin"],
]);
if (count($user) != 1) {
    $response->setfail(true, "Dieser Pin ist nicht valide.");
    return;
}
$response->setresponse($user[0]["id"]);
