<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "groupid", "product"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$servicecount = $masterdatabase->select("service_main", "*", [
    "produktid" => $_POST["product"],
    "serviceid" => $_POST["id"],
]);

if (count($servicecount) != 1) {
    $response->setfail(true, "Dieser Service existiert nicht.");
    return;
}

$masterdatabase->update("service_main", [
    "groupid" => $_POST["groupid"]
], [
    "produktid" => $_POST["product"],
    "serviceid" => $_POST["id"],
]);
