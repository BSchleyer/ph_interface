<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "ip", "webspaceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$webspace = new Webspace($masterdatabase, $config);

$respond = $webspace->getsession($_POST["userid"], $_POST["ip"], $_POST["webspaceid"]);
$response->setresponse($respond->id);
