<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$service = new Service($dependencyInjector, null);
$service->massUpdate(["groupid" => 0], ["groupid" => $_POST["id"]]);

$group = new ServiceGroup($dependencyInjector, $_POST["id"]);
$group->delete();


$response->setresponse($group->getValue("userid"));