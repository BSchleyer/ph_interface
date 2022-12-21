<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["link"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$link = new ExternLink($masterdatabase, $config);

$respond = $link->getlinkinfo($_POST["link"]);
$response->setresponse($respond);
