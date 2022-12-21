<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "ostype"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$masterdatabase->update("vserver_main", [
    "imageid" => $_POST["ostype"],
], [
    "id" => $_POST["id"],
]);

$vserver = new \Ph24\service\VServer($dependencyInjector, $_POST["id"], "childid");

$vserver->reinstall();

if($dependencyInjector->isFail()){
    $response->setfail(true, $dependencyInjector->getMessage());
    return;
}
