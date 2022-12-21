<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$group = new ServiceGroup($dependencyInjector, $_POST["id"]);


$response->setresponse($group->getValue("userid"));