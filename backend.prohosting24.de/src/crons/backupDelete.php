<?php



$node = new Node($dependencyInjector);

$node->load_id($dependencyInjector->getDatabase(), 6);

$backupList = $node->getAllBackups();

$vserverBackups = [];

foreach ($backupList as $backup){
    if(!isset($vserverBackups[$backup["vmid"]])){
        $vserverBackups[$backup["vmid"]] = [];
    }
    $vserverBackups[$backup["vmid"]][] = $backup;
}


foreach ($vserverBackups as $vmId => $backupData){
    if($vmId < 1000){
        
        continue;
    }
    $vserver = new \Ph24\service\VServer($dependencyInjector, $vmId, "childid");
    $backupSlots = $vserver->getChildValue("backupslots") + 1;
    if(count($backupData) > $backupSlots){
        Functions::errorLog("proxmoxBackupDeleteStart","Delete backup start", [
            "vmid" => $vmId,
            "backupSlots" => $backupSlots,
            "backupUsage" => count($backupData)
        ], false);
        foreach ($backupData as $key => $backup){
            if(count($backupData) <= $backupSlots){
                continue;
            }
            unset($backupData[$key]);
            Functions::errorLog("proxmoxBackupDelete","Delete backup create task", [
                "vmid" => $backup["vmid"],
                "backup" => $backup["volid"],
                "backupSlots" => $backupSlots,
                "backupUsage" => count($backupData)
            ], false);
            $backupId = explode("/", $backup["volid"]);
            $queue = new VServerQueue($dependencyInjector, null);
            $queue->setValue("serviceid", $vserver->getChildValue("id"));
            $queue->setValue("action", 10);
            $queue->setValue("data", $vserver->getChildValue("id") . "/" . $backupId[3]);
            $queue->create();
        }
        Functions::errorLog("proxmoxBackupDeleteFinish","Delete backup finish", [
            "vmid" => $vmId,
            "backupSlots" => $backupSlots,
            "backupUsage" => count($backupData)
        ], false);
    } else {
        Functions::errorLog("proxmoxBackupNoDelete","No backups to delete", [
            "vmid" => $vmId,
            "backupSlots" => $backupSlots,
            "backupUsage" => count($backupData)
        ], false);
    }
}