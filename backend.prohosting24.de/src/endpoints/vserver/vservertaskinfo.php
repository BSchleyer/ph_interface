<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "pid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vserver = new VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);

$currentData = $vserver->getcurrent();

if(!isset($currentData["data"]["status"]) && $currentData["data"]["status"] != "running"){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceagentnotenabled"));
}

if(!isset($currentData["data"]["uptime"])){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceagentnotenabled"));
}
$time = time() - $currentData["data"]["uptime"];

$execList = new VserverExecList($dependencyInjector, null);

$execListEntry = $execList->getAll(["vserverid" => $_POST["id"],"pid" => $_POST["pid"], "created_on[>]" => date("Y-m-d H:i:s", $time)]);

if(count($execListEntry) != 1){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceagentnotenabled"));
}

$execListEntry = $execListEntry[0];

if($execListEntry->getValue("status") == 1){
    $returnData = [];

    $returnData["out"] = $execListEntry->getValue("output");

    $returnData["exitcode"] = $execListEntry->getValue("exitcode");
    $response->setresponse($returnData);
    return;
}

$agentData = $vserver->getAgentInfo();

if(!isset($agentData["data"]["result"])){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceagentnotenabled"));
}

$data = $vserver->getCommandStatus($_POST["pid"]);

if(!isset($data["data"])){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceexecerror"));
}

if($data["data"]["exited"] == 0){
    $response->fail(500, $dependencyInjector->getLang()->getString("serviceexecprocessrunning"));
}

$data = $data["data"];

$returnData = [];

$returnData["out"] = "";

$returnData["exitcode"] = $data["exitcode"];

if(isset($data["err-data"])){
    $returnData["out"] .= htmlspecialchars($data["err-data"]);
}

if(isset($data["out-data"])){
    $returnData["out"] .= htmlspecialchars($data["out-data"]);
}

$execListEntry->setValue("status", 1);
$execListEntry->setValue("output", $returnData["out"]);
$execListEntry->setValue("exitcode", $returnData["exitcode"]);
$execListEntry->update();

$response->setresponse($returnData);
