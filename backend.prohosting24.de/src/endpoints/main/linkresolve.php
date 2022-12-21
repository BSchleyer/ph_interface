<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["link", "data"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$link = new ExternLink($masterdatabase, $config);

$respond = $link->resolvelink($_POST["link"], json_decode($_POST["data"], true));

if ($respond != "") {
    $response->setfail(true, $respond);
    return;
}
