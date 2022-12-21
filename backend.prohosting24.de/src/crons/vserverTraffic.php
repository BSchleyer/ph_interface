<?php




$node = new \Ph24\service\VServerNode($dependencyInjector, null);

$nodes = $node->getall([]);

foreach ($nodes as $node){
    $stats = $node->getQemuStats();
    if(!isset($stats["data"])){
        continue;
    }
    foreach ($stats["data"] as $vmStats){
        $vmStats["netin"] = $vmStats["netin"] / 1000000;
        $vmStats["netout"] = $vmStats["netout"] / 1000000;
        $log = true;
        $lastTrafficIn = new TrafficInLog($dependencyInjector, null);
        $lastTrafficIn = $lastTrafficIn->getAll(["proxmoxid" => $vmStats["vmid"], "LIMIT" => 1, "ORDER" => ["id" => "DESC"] ]);
        if(count($lastTrafficIn) == 0){
            $lastTrafficIn = new TrafficInLog($dependencyInjector, null);
            $lastTrafficIn->setValue("count", 0);
            $lastTrafficIn->setValue("lastlog", 0);
        } else {
            $lastTrafficIn = $lastTrafficIn[0];
        }
        $result = round($vmStats["netin"] - $lastTrafficIn->getValue("lastlog"), 0);
        if($result == 0){
            $log = false;
        }
        if($result < 0){
            $result = round($vmStats["netin"], 0);
            if($result == 0){
                $log = false;
            }
        }
        if($log){
            $newTrafficIn = new TrafficInLog($dependencyInjector, null);
            $newTrafficIn->setValue("count", $result);
            $newTrafficIn->setValue("lastlog", round($vmStats["netin"]));
            $newTrafficIn->setValue("proxmoxid", $vmStats["vmid"]);
            $newTrafficIn->create();
        }

        $log = true;
        $lastTrafficOut = new TrafficOutLog($dependencyInjector, null);
        $lastTrafficOut = $lastTrafficOut->getAll(["proxmoxid" => $vmStats["vmid"], "LIMIT" => 1, "ORDER" => ["id" => "DESC"] ]);

        if(count($lastTrafficOut) == 0){
            $lastTrafficOut = new TrafficOutLog($dependencyInjector, null);
            $lastTrafficOut->setValue("count", 0);
            $lastTrafficOut->setValue("lastlog", 0);
        } else {
            $lastTrafficOut = $lastTrafficOut[0];
        }

        $result = round($vmStats["netout"] - $lastTrafficOut->getValue("lastlog"), 0);
        if($result == 0){
            $log = false;
        }
        if($result < 0){
            $result = round($vmStats["netout"], 0);
            if($result == 0){
                $log = false;
            }
        }
        if($log){
            $newTrafficout = new TrafficOutLog($dependencyInjector, null);
            $newTrafficout->setValue("count", $result);
            $newTrafficout->setValue("lastlog", round($vmStats["netout"]));
            $newTrafficout->setValue("proxmoxid", $vmStats["vmid"]);
            $newTrafficout->create();
        }

    }
}