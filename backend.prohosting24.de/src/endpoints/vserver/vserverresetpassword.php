<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id","userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);


    $server = new VServer($dependencyInjector);
    $server->loadwithid($_POST["id"]);
    $server->resetVmPassword();
