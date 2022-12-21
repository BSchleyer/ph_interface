<?php





if (!checkpost($_POST, ["backup", "id"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$queue = new VServerQueue($dependencyInjector, null);

$counter = $queue->getAll(["serviceid" => $_POST["id"], "status" => [0,1]]);
if(count($counter) != 0){
    $response->setfail(true, $dependencyInjector->getLang()->getString("queuetaskrunning"));
    return;
}


$vserver = New VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);
$proxmoxid = $vserver->getProxmoxid();
$allbackups = $vserver->getallbackups();

foreach ($allbackups as $backup) {
	if (strpos($backup["volid"], $_POST["backup"]) !== false) {
	    $queue = new VServerQueue($dependencyInjector, null);
	    $queue->setValue("serviceid", $_POST["id"]);
	    $queue->setValue("action", 2);
	    $queue->setValue("nextid", "4,11");
        $queue->setValue("data", $backup["volid"]);
	    $queue->create();
	}
}
