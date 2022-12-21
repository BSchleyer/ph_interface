<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["internid", "name", "icon"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$newimage = new Image();

$newimage->setInternid($_POST["internid"]);
$newimage->setName($_POST["name"]);
$newimage->setIcon($_POST["icon"]);

if (!$newimage->create($masterdatabase)) {
    $response->setfail(true, "Database Error while creating the Image");
    return;
}
