<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid", "status"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);
$user->setStatus($_POST["status"]);
$user->save("status", $masterdatabase);
