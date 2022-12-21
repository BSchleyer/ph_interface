<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$newpackage = new VServerPacket($masterdatabase, $config);
$newpackage->delete($_POST["id"]);
