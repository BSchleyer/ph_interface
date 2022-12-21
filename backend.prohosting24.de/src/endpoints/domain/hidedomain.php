<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$masterdatabase->update("service_main", [
    "hide" => 1,
], [
    "serviceid" => $_POST["id"],
    "produktid" => 4,
]);
