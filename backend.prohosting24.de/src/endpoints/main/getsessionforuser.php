<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid", "ip"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$loginuser = new User();


$getinfo = $loginuser->load_id($masterdatabase, $_POST["userid"]);

$sessionid = $loginuser->newsession($masterdatabase, "1", $_POST["ip"]);
$response->setresponse($sessionid);
