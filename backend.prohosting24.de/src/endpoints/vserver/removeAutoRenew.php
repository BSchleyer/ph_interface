<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "productId"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$service = $masterdatabase->update("service_main", [
    "autorenew" => 0,
], [
    "serviceid" => $_POST["id"],
    "produktid" => $_POST["productId"]
]);