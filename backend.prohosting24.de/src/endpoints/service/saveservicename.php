<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "name", "product"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
if ($_POST["name"] == '') {
    $response->setfail(true, "Die Maximale Länge ist 64 Zeichen.");
    return;
}

if (strlen($_POST["name"]) > 64) {
    $response->setfail(true, "Die Maximale Länge ist 64 Zeichen.");
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
    "name" => htmlspecialchars(preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $_POST["name"])),
], [
    "produktid" => $_POST["product"],
    "serviceid" => $_POST["id"],
]);
