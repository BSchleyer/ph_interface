<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["header", "content"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->insert("main_changelog", [
    "header" => $_POST["header"],
    "content" => $_POST["content"],
]);
