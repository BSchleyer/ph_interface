<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vservers = $masterdatabase->select("domain_main", [
    "userid",
], [
    "id" => $_POST["id"],
]);

$response->setresponse($vservers[0]["userid"]);
