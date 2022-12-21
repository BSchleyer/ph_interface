<?php



$service = new Service($dependencyInjector, null);
$serviceList = $service->getAll(["hourly" => 1, "delete_done" => 0, "produktid" => 1]);

foreach ($serviceList as $service){
    $vServer = new VServer($dependencyInjector);
    $vServer->loadwithid($service->getValue("serviceid"));

    $traffic = $vServer->getTraffic();

    $log = true;
    $lastTrafficIn = new HourlyTrafficInLog($dependencyInjector, null);
    $lastTrafficIn = $lastTrafficIn->getAll(["serviceid" => $service->getValue("id"), "LIMIT" => 1, "ORDER" => ["id" => "DESC"] ]);

    if(count($lastTrafficIn) == 0){
        $lastTrafficIn = new HourlyTrafficInLog($dependencyInjector, null);
        $lastTrafficIn->setValue("count", 0);
        $lastTrafficIn->setValue("lastlog", 0);
    } else {
        $lastTrafficIn = $lastTrafficIn[0];
    }

    $result = round($traffic["in"] - $lastTrafficIn->getValue("lastlog"), 0);
    if($result == 0){
        $log = false;
    }
    if($result < 0){
        $result = round($traffic["in"], 0);
        if($result == 0){
            $log = false;
        }
    }
    if($log){
        $newTrafficIn = new HourlyTrafficInLog($dependencyInjector, null);
        $newTrafficIn->setValue("count", $result);
        $newTrafficIn->setValue("lastlog", round($traffic["in"]));
        $newTrafficIn->setValue("serviceid", $service->getValue("id"));
        $newTrafficIn->create();
    }

    $log = true;
    $lastTrafficOut = new HourlyTrafficOutLog($dependencyInjector, null);
    $lastTrafficOut = $lastTrafficOut->getAll(["serviceid" => $service->getValue("id"), "LIMIT" => 1, "ORDER" => ["id" => "DESC"] ]);

    if(count($lastTrafficOut) == 0){
        $lastTrafficOut = new HourlyTrafficOutLog($dependencyInjector, null);
        $lastTrafficOut->setValue("count", 0);
        $lastTrafficOut->setValue("lastlog", 0);
    } else {
        $lastTrafficOut = $lastTrafficOut[0];
    }

    $result = round($traffic["out"] - $lastTrafficOut->getValue("lastlog"), 0);
    if($result == 0){
        $log = false;
    }
    if($result < 0){
        $result = round($traffic["out"], 0);
        if($result == 0){
            $log = false;
        }
    }
    if($log){
        $newTrafficout = new HourlyTrafficOutLog($dependencyInjector, null);
        $newTrafficout->setValue("count", $result);
        $newTrafficout->setValue("lastlog", round($traffic["out"]));
        $newTrafficout->setValue("serviceid", $service->getValue("id"));
        $newTrafficout->create();
    }

    print_r($traffic);
}