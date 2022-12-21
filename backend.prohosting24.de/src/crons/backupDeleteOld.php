<?php



$node = new Node($dependencyInjector);

$node->load_id($dependencyInjector->getDatabase(), 6);

$backupList = $node->getAllBackups();

$vmList = $node->getAllServers();

Functions::errorLog("proxmoxLostBackupDeleteStart","Delete backup start", [], false);
$deleteBackupCount = 0;
foreach ($backupList as $backup){
    if($backup["vmid"] < 1000){
        
        continue;
    }
    if(!in_array($backup["vmid"],$vmList )){
        Functions::errorLog("proxmoxLostBackupDelete","Delete backup create task", [
            "vmid" => $backup["vmid"],
            "backup" => $backup["volid"]
        ], false);
        $deleteBackupCount++;
        $backupId = explode("/", $backup["volid"]);
        $queue = new VServerQueue($dependencyInjector, null);
        $queue->setValue("serviceid", $backup["vmid"]);
        $queue->setValue("action", 10);
        $queue->setValue("data", $backup["vmid"] . "/" . $backupId[3]);
        $queue->create();
    }
}
Functions::errorLog("proxmoxLostBackupDeleteFinish","Delete backup finish", [
    "deletedBackups" => $deleteBackupCount,
], false);