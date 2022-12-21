<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$service = $masterdatabase->update("service_main", [
    "hide" => 1,
], [
    "id" => $_POST["id"],
]);