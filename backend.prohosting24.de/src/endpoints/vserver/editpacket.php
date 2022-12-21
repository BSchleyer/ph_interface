<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["id", "sortid", "cores", "memory", "disk", "price", "title", "description"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$newpackage = new VServerPacket($masterdatabase, $config);
$newpackage->update($_POST["id"], $_POST["sortid"], $_POST["cores"], $_POST["memory"], $_POST["disk"], $_POST["price"], $_POST["title"], $_POST["description"]);
