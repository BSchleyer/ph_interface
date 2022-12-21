<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$service = $masterdatabase->select("service_main", [
    "userid",
], [
    "id" => $_POST["id"],
]);

$response->setresponse($service[0]["userid"]);