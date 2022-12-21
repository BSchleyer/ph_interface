<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["type", "data", "count", "code"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$discount = new Discount($masterdatabase, $config);
$discount->create($_POST["type"], json_decode($_POST["data"], true), $_POST["count"], $_POST["code"], null);
