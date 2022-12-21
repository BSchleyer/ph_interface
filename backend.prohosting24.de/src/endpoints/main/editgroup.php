<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["name", "id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->update("main_groups", [
    "name" => $_POST["name"],
], [
    "id" => $_POST["id"],
]);
