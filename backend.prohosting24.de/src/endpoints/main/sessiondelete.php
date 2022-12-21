<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$user = new User();

$user->load_sessionid($masterdatabase, $_POST["sessionid"]);


$user->deleteSessionid($masterdatabase, $_POST["sessionid"], $_POST["ip"]);
