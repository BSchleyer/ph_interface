<?php


if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$vservers = $masterdatabase->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.status",
    "service_main.hourly",
    "service_main.upgradeble",
    "service_main.id(serviceid)",
    "vserver_main.id",
    "vserver_main.nodeid",
    "service_main.userid",
    "service_main.name",
    "vserver_main.cores",
    "vserver_main.memory",
    "vserver_main.disk",
    "vserver_main.proxmoxid",
    "vserver_main.backupslots",
    "vserver_main.backuphour",
    "vserver_main.packet",
    "vserver_main.imageid",
    "service_main.price",
    "service_main.discount",
    "service_main.autorenew",
    "vserver_main.created_on",
], [
    "service_main.produktid" => 1,
    "vserver_main.id" => $_POST["id"],
]);
if ($vservers[0]["status"] == 1) {
    $response->setfail(true, "Dieser Service ist gesperrt.");
    return;
}
foreach ($vservers as $key => $vserver) {
    $access = new AccessUser($dependencyInjector, null);
    $access = $access->getAll(["serviceid" => $vserver["serviceid"], "status" => 1]);
    $accessList = [];

    foreach ($access as $accessEntry){
        $accessList[] = $accessEntry->getValue("userid");
    }
    $vservers[$key]["accessUsers"] = $accessList;
	$vservers[$key]["price"] = $vserver["price"] * (1 - $vserver["discount"]);
	$queue = new VServerQueueNew($dependencyInjector, null);
	$queueEntry = $queue->getQueue($vserver["id"]);
    $oldQueue = new VServerQueue($dependencyInjector, null);
    $queueList = $oldQueue->getAll(["serviceid" => $vserver["id"], "status" => [0,1]]);
	$vservertmp = new VServer($dependencyInjector);
	$vservertmp->loadwithid($vserver["id"]);
	$vservers[$key]["ip"] = count($vservertmp->getips()[0]);
	$expire = strtotime($vserver["expire_at"]);
	$now = time();
	$vservers[$key]["daysleft"] = floor(($expire - $now) / (24 * 60 * 60));
    $vservers[$key]["status"] = "error";
	if ((strtotime($vserver["expire_at"]) - time()) < 0) {
		if ($vserver["delete_at"] != null) {
			if ((strtotime($vserver["delete_at"]) - time()) < 0) {
				$vservers[$key]["status"] = "deleted";
			} else {
                $vservers[$key]["status"] = "expired";
            }
        } else {
            $vservers[$key]["status"] = "expired";
        }
    } else {
        if (count($queueEntry) != 0) {
            if($queueEntry["status"] == 3){
                $vservers[$key]["status"] = "error";
            } else {
                foreach ($queueEntry["tasks"] as $entry){
                    if(in_array($entry["status"],[0,1])){
                        $vservers[$key]["status"] = $entry["action"];
                        switch ($entry["action"]){
                            default:
                                $vservers[$key]["status"] = $entry["action"];
                                break;
                            case 'start':
                            case 'migrateToBestNode':
                            case 'configOnly':
                            case 'changeCPUType':
                            case 'reset':
                                $vservers[$key]["status"] = "starting";
                                break;
                            case 'stop':
                                $vservers[$key]["status"] = "stopping";
                                break;
                            case 'shutdown':
                                $vservers[$key]["status"] = "shutdown";
                                break;
                            case 'firewall':
                            case 'delete':
                            case 'resizeDisk':
                            case 'config':
                            case 'create':
                            case 'windowsSetNetwork':
                                $vservers[$key]["status"] = "installing";
                                break;
                        }
                        break;
                    }
                }
            }
        } elseif (count($queueList) != 0){
            foreach ($queueList as $entry){
                switch ($entry->getValue("action")){
                    case 11:
                        if($entry->getValue("status") != 1){
                            $vservers[$key]["backup"] = "plannedrestore";
                        } else {
                            $backupStatus = $vservertmp->checktaskdb($entry->getValue("taskid"), $entry->getValue("nodename"), true);
                            if($backupStatus == null){
                                $vservers[$key]["backup"] = "plannedrestore";
                            } else {
                                if(count($backupStatus["data"]) == 0){
                                    $vservers[$key]["backup"] = "plannedrestore";
                                } else {
                                    $lastEntry = $backupStatus["data"][count($backupStatus["data"]) - 1];
                                    if (strpos($lastEntry["t"], 'progress') !== false) {
                                        $vservers[$key]["backup"] = explode("%", $lastEntry["t"])[0];
                                        $vservers[$key]["backup"] = str_replace("progress ", "",$vservers[$key]["backup"]);
                                    } else {
                                        $vservers[$key]["backup"] = "plannedrestore";
                                    }
                                }
                            }
                        }
                        $vservers[$key]["status"] = "backuprestore";
                        break;
                    case 9:
                        if($entry->getValue("status") != 1){
                            $vservers[$key]["backup"] = "planned";
                        } else {
                            $backupStatus = $vservertmp->checktaskdb($entry->getValue("taskid"), $entry->getValue("nodename"), true);
                            if($backupStatus == null){
                                $vservers[$key]["backup"] = "planned";
                            } else {
                                if(count($backupStatus["data"]) == 0){
                                    $vservers[$key]["backup"] = "planned";
                                } else {
                                    $lastEntry = $backupStatus["data"][count($backupStatus["data"]) - 1];
                                    if (strpos($lastEntry["t"], '%') !== false) {
                                        $vservers[$key]["backup"] = $lastEntry["t"];
                                        $vservers[$key]["backup"] = explode(":", $vservers[$key]["backup"])[1];
                                        $vservers[$key]["backup"] = str_replace(" ", "",explode("%", $vservers[$key]["backup"])[0]);
                                    } else {
                                        $vservers[$key]["backup"] = "planned";
                                    }
                                }
                            }
                        }
                        $vservers[$key]["status"] = "backup";
                        break;
                }
                break;
            }
        } else {
            $tmpData = $vservertmp->getcurrent();
            if(isset($tmpData["data"]["status"])){
                $vservers[$key]["status"] = $tmpData["data"]["status"];
            } else {
                $vservers[$key]["status"] = "proxmoxconnectionerror";
            }
            $agentInfo = $vservertmp->getAgentInfo();
            if(!isset($agentInfo["data"]["result"])){
                $vservers[$key]["agent"] = 0;
            } else {
                $vservers[$key]["agent"] = 1;
            }
        }
    }
    $vserverstats = $vservertmp->getcurrent();
    if(isset($vserverstats["data"]["uptime"])){
        $vservers[$key]["uptime"] = $vserverstats["data"]["uptime"];
    } else {
        $vservers[$key]["uptime"] = 0;
    }
    $vservers[$key]["timeleftdelete"] = strtotime($vserver["delete_at"]);
    $vservers[$key]["timeleft"] = strtotime($vserver["expire_at"]);
    if(!isset($vserver["name"])){
        $vservers[$key]["name"] = "#" . $vserver["id"];
    } else {
        $vservers[$key]["name"] = htmlspecialchars($vserver["name"]);
    }
}

$response->setresponse($vservers[0]);
