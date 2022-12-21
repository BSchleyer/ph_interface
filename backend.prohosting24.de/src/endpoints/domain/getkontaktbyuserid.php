<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$domain = new Domain($masterdatabase, $config);

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$res = $domain->getkontaktbyuserid($_POST["userid"]);
$response->setresponse($res);
