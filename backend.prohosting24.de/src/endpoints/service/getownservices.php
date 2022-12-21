<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$servicelist = [];
$services = $masterdatabase->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.name",
    "service_main.hourly",
    "service_main.status",
    "vserver_main.id",
    "service_main.id(mainid)",
    "vserver_main.proxmoxid",
    "vserver_main.cores",
    "vserver_main.memory",
    "service_main.groupid",
    "vserver_main.disk",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 1,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $vserver) {
    $services[$key]["name"] = htmlspecialchars($services[$key]["name"]);
    if ($vserver["status"] == 1) {
        $services[$key]["status"] = "locked";
    } else {
        $queue = new VServerQueueNew($dependencyInjector, null);
        $queueEntry = $queue->getQueue($vserver["id"]);
        $oldQueue = new VServerQueue($dependencyInjector, null);
        $queueList = $queue->getAll(["serviceid" => $vserver["id"], "status" => [0,1]]);
        $services[$key]["status"] = "error";
        if ((strtotime($vserver["expire_at"]) - time()) < 0) {
            if ($vserver["delete_at"] != null) {
                if ((strtotime($vserver["delete_at"]) - time()) < 0) {
                    $services[$key]["status"] = "deleted";
                } else {
                    $services[$key]["status"] = "expired";
                }
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            if (count($queueEntry) != 0) {
                if($queueEntry["status"] == 3){
                    $vservers[$key]["status"] = "error";
                } else {
                    foreach ($queueEntry["tasks"] as $entry) {
                        if (in_array($entry["status"], [0, 1])) {
                            $services[$key]["status"] = $entry["action"];
                            switch ($entry["action"]) {
                                default:
                                    $services[$key]["status"] = $entry["action"];
                                    break;
                                case 'start':
                                case 'migrateToBestNode':
                                case 'configOnly':
                                case 'changeCPUType':
                                case 'reset':
                                    $services[$key]["status"] = "starting";
                                    break;
                                case 'stop':
                                    $services[$key]["status"] = "stopping";
                                    break;
                                case 'shutdown':
                                    $services[$key]["status"] = "shutdown";
                                    break;
                                case 'firewall':
                                case 'delete':
                                case 'resizeDisk':
                                case 'config':
                                case 'create':
                                case 'windowsSetNetwork':
                                    $services[$key]["status"] = "installing";
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
                            $services[$key]["status"] = "backuprestore";
                            break;
                        case 9:
                            $services[$key]["status"] = "backup";
                            break;
                    }
                }
            } else {
				$vservertmp = new VServer($dependencyInjector);
                $vservertmp->loadwithid($vserver["id"]);
                $tmpData = $vservertmp->getcurrent();
                if(isset($tmpData["data"]["status"])){
                    $services[$key]["status"] = $tmpData["data"]["status"];
                } else {
                    $services[$key]["status"] = "error";
                }
			}
        }
    }
    $services[$key]["groupid"] = $vserver["groupid"];
    $services[$key]["delete_at"] = strtotime($vserver["delete_at"]);
    $services[$key]["timeleft"] = strtotime($vserver["expire_at"]);
}
$servicelist["vserver"] = $services;

$services = $masterdatabase->select("service_main", [
    "[>]webspace_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.name",
    "service_main.status",
    "webspace_main.id",
    "service_main.id(mainid)",
    "webspace_main.pleskid",
    "service_main.groupid",
    "webspace_main.domain",
    "webspace_main.guid",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 2,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $webspace) {
    $services[$key]["name"] = htmlspecialchars($services[$key]["name"]);
    if ($webspace["status"] == 1) {
        $services[$key]["status"] = "locked";
    } else {
        if ((strtotime($webspace["expire_at"]) - time()) < 0) {
            if ($webspace["delete_at"] != null) {
                if ((strtotime($webspace["delete_at"]) - time()) < 0) {
                    $services[$key]["status"] = "deleted";
                } else {
                    $services[$key]["status"] = "expired";
                }
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $services[$key]["status"] = "running";
        }
    }
    $services[$key]["groupid"] = $webspace["groupid"];
    $services[$key]["delete_at"] = strtotime($webspace["delete_at"]);
    $services[$key]["timeleft"] = strtotime($webspace["expire_at"]);
}

$servicelist["webspace"] = $services;

$services = $masterdatabase->select("service_main", [
    "[>]domain_main" => ["serviceid" => "id"],
    "[>]domain_list" => ["domain_main.tld" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.name",
    "service_main.status",
    "domain_main.id",
    "service_main.id(mainid)",
    "domain_list.tld",
    "domain_main.sld",
    "domain_main.kontakt",
    "service_main.groupid",
    "domain_main.ns1",
    "domain_main.ns2",
    "domain_main.ns3",
    "domain_main.ns4",
    "domain_main.ns5",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 4,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $domain) {
    $services[$key]["name"] = htmlspecialchars($services[$key]["name"]);
    if ($domain["status"] == 1) {
        $services[$key]["status"] = "locked";
    } else {
        if ((strtotime($domain["expire_at"]) - time()) < 0) {
            if ($domain["delete_at"] != null) {
                if ((strtotime($domain["delete_at"]) - time()) < 0) {
                    $services[$key]["status"] = "deleted";
                } else {
                    $services[$key]["status"] = "expired";
                }
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $services[$key]["status"] = "running";
        }
    }
    $services[$key]["groupid"] = $domain["groupid"];
    $services[$key]["delete_at"] = strtotime($domain["delete_at"]);
    $services[$key]["timeleft"] = strtotime($domain["expire_at"]);
}

$servicelist["domains"] = $services;



$services = $masterdatabase->select("service_main", [
    "[>]ptero_main" => ["serviceid" => "id"],
    "[>]ptero_products" => ["ptero_main.productid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.name",
    "service_main.id(mainid)",
    "ptero_main.id",
    "service_main.status",
    "service_main.groupid",
    "ptero_main.pteroid",
    "ptero_main.productid",
    "ptero_main.nodeid",
    "ptero_main.packetid",
    "ptero_products.displayname",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 5,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $ptero) {
    $services[$key]["name"] = htmlspecialchars($services[$key]["name"]);
    if ($ptero["status"] == 1) {
        $services[$key]["status"] = "locked";
    } else {
        if ((strtotime($ptero["expire_at"]) - time()) < 0) {
            if ($ptero["delete_at"] != null) {
                if ((strtotime($ptero["delete_at"]) - time()) < 0) {
                    $services[$key]["status"] = "deleted";
                } else {
                    $services[$key]["status"] = "expired";
                }
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $pteroService = new PteroService($dependencyInjector, $ptero["serviceid"]);
            try {
                $services[$key]["status"] = $pteroService->getStatus()->currentState;
            } catch (Exception $e){
                $services[$key]["status"] = "installing";
            }
        }
    }
    $services[$key]["groupid"] = $ptero["groupid"];
    $services[$key]["displayName"] = $ptero["displayname"];
    $services[$key]["delete_at"] = strtotime($ptero["delete_at"]);
    $services[$key]["timeleft"] = strtotime($ptero["expire_at"]);
}

$servicelist["app"] = $services;


$groups = new ServiceGroup($dependencyInjector, null);
$servicelist["groups"] = $groups->getAll(["userid" => $_POST["userid"]], true);

$response->setresponse($servicelist);
