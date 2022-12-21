<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["vserver"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$vserver = new VServer($dependencyInjector);
$vserver->loadwithid($_POST["vserver"]);
$response->setresponse($vserver->getTrafficStats());