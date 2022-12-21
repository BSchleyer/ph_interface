<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vservers = $masterdatabase->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.userid",
], [
    "vserver_main.id" => $_POST["id"],
    "service_main.produktid" => 1,
]);

$response->setresponse($vservers[0]["userid"]);
