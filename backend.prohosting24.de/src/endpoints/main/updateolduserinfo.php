<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["firstname", "lastname", "username", "userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->update("main_user", [
    "username" => $_POST["username"],
    "vorname" => $_POST["firstname"],
    "nachname" => $_POST["lastname"],
    "status" => 0,
], [
    "id[=]" => $_POST["userid"],
]);
