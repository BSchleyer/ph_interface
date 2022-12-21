<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->insert("main_rights", [
    "name" => $_POST["name"],
]);
