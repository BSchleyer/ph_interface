<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
$nodet = new Node($dependencyInjector);
$nodet->load_id($masterdatabase, 6);
$nodet->openconnection();
$clusterlog = $nodet->getclustertasks();
$clusterlogdb = $masterdatabase->select("vserver_proxmoxlog", "*", [
    "ORDER" => ["id" => "DESC"],
    "LIMIT" => 200,
]);
$clusterlogf = [];
foreach ($clusterlogdb as $logentry) {
    $clusterlogf[] = $logentry["proxmoxid"];
}
if($clusterlog["data"] != null){
    foreach ($clusterlog["data"] as $log) {
        if (in_array($log["upid"], $clusterlogf)) {
            continue;
        }
        switch ($log["type"]) {
            case 'qmigrate':
                if(isset($log["status"])){
                    if ($log["status"] == "OK") {
                        $vserverid = $log["id"];
                        
                        $vserver = new VServer($dependencyInjector);
                        $vserver->loadwithid($vserverid);
                        $nodeid = $vserver->findvmincluster();
                        $vserver->changenodeid($nodeid);
                        
                        $masterdatabase->insert("vserver_proxmoxlog", [
                            "proxmoxid" => $log["upid"],
                            "type" => $log["type"],
                        ]);
                    }
                }
                break;
            default:
                
                $masterdatabase->insert("vserver_proxmoxlog", [
                    "proxmoxid" => $log["upid"],
                    "type" => $log["type"],
                ]);
                break;
        }
    }
}