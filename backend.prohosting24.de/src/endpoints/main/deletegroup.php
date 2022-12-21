<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

if (!checkstringtodatabase($masterdatabase, "main_groups", "id", $_POST["id"])) {
    $response->setfail(true, "Diese Gruppe existiert nicht");
    return;
}

if (checkstringtodatabase($masterdatabase, "main_group_to_rights", "groupid", $_POST["id"])) {
    $response->setfail(true, "Diese Gruppe hat noch zugewiesene Rechte");
    return;
}
if (checkstringtodatabase($masterdatabase, "main_user_to_group", "groupid", $_POST["id"])) {
    $response->setfail(true, "In dieser Gruppe sind noch Nutzer");
    return;
}

$masterdatabase->delete("main_groups", [
    "id" => $_POST["id"],
]);
