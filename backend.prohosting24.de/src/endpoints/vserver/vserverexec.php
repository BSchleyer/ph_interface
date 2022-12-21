<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "command"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vserver = new VServer($dependencyInjector);

$vserver->loadwithid($_POST["id"]);

$agentData = $vserver->getAgentInfo();

if(!isset($agentData["data"]["result"])){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceagentnotenabled"));
}

$data = $vserver->executecommand($_POST["command"]);


if(!isset($data["data"]["pid"])){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceexecerror"));
}

$pid = $data["data"]["pid"];

$execList = new VserverExecList($dependencyInjector, null);
$execList->setValue("vserverid", $_POST["id"]);
$execList->setValue("pid", $pid);
$execList->setValue("command", htmlspecialchars($_POST["command"]));
$execList->create();
