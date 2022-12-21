<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["serviceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->update("service_main", [
    "status" => 1,
], [
    "id" => $_POST["serviceid"],
]);
