<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$domain = new Domain($masterdatabase, $config);

if (!checkpost($_POST, ["nameserver"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$res = $domain->addnameserver($_POST["nameserver"]);
$response->setresponse($res);
