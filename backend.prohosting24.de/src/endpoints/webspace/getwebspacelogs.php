<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$logs = $masterdatabase->select("main_log", [
    "id",
    "log",
    "created_on",
], [
    "row_value" => $_POST["id"],
    "row_name" => "id",
    "table_name" => "webspace_main",
]);

$response->setresponse($logs);
