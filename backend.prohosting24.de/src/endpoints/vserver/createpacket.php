<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["sortid", "cores", "memory", "disk", "price", "title", "description"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$newpackage = new VServerPacket($masterdatabase, $config);
$newpackage->create($_POST["sortid"], $_POST["cores"], $_POST["memory"], $_POST["disk"], $_POST["price"], $_POST["title"], $_POST["description"]);
