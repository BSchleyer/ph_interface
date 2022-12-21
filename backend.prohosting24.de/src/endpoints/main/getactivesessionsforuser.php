<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$sessions = $masterdatabase->select("main_user_sessions", [
    "id",
    "valid_until",
    "created_on",
    "ip",
], [
    "userid" => $_POST["userid"],
    "ORDER" => ["id" => "ASC"],
]);
$response->setresponse($sessions);
