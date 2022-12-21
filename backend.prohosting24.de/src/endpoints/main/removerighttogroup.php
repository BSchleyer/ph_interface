<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["rightid", "groupid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$masterdatabase->delete("main_group_to_rights", [
    "rightid" => $_POST["rightid"],
    "groupid" => $_POST["groupid"],
]);
