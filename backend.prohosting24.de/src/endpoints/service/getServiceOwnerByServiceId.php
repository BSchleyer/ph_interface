<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id","productId"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$service = $masterdatabase->select("service_main", [
    "userid",
], [
    "serviceid" => $_POST["id"],
    "produktid" => $_POST["productId"]
]);

$response->setresponse($service[0]["userid"]);