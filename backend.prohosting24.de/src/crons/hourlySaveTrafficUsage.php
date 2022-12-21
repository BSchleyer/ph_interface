<?php


$trafficLogService = [];

$trafficLogIn = new HourlyTrafficInLog($dependencyInjector, null);
$trafficLogInList = $trafficLogIn->getAll(["processed" => 0]);

foreach ($trafficLogInList as $entry){
    if(!isset($trafficLogService[$entry->getValue("serviceid")])){
        $trafficLogService[$entry->getValue("serviceid")] = [];
        $trafficLogService[$entry->getValue("serviceid")]["trafficIn"] = 0;
        $trafficLogService[$entry->getValue("serviceid")]["trafficOut"] = 0;
    }
    $trafficLogService[$entry->getValue("serviceid")]["trafficIn"] += $entry->getValue("count");
}

$trafficLogOut = new HourlyTrafficOutLog($dependencyInjector, null);
$trafficLogOutList = $trafficLogOut->getAll(["processed" => 0]);

foreach ($trafficLogOutList as $entry){
    if(!isset($trafficLogService[$entry->getValue("serviceid")])){
        $trafficLogService[$entry->getValue("serviceid")] = [];
        $trafficLogService[$entry->getValue("serviceid")]["trafficOut"] = 0;
        $trafficLogService[$entry->getValue("serviceid")]["trafficIn"] = 0;
    }
    $trafficLogService[$entry->getValue("serviceid")]["trafficOut"] += $entry->getValue("count");
}

$trafficInPrice = new HourlyTrafficInPrice($dependencyInjector, 1);
$trafficOutPrice = new HourlyTrafficOutPrice($dependencyInjector, 1);

$priceMBIn = ($trafficInPrice->getValue("price") / 1000) / 1000;
$priceMBOut = ($trafficOutPrice->getValue("price") / 1000) / 1000;

foreach ($trafficLogService as $serviceId => $service){
    $hourlyTrafficIn = new HourlyTrafficIn($dependencyInjector, null);
    $hourlyTrafficIn->setValue("serviceid", $serviceId);
    $hourlyTrafficIn->setValue("count", $service["trafficIn"]);
    $hourlyTrafficIn->setValue("price", $service["trafficIn"] * $priceMBIn);
    $hourlyTrafficIn->create();
    $hourlyTrafficOut = new HourlyTrafficOut($dependencyInjector, null);
    $hourlyTrafficOut->setValue("serviceid", $serviceId);
    $hourlyTrafficOut->setValue("count", $service["trafficOut"]);
    $hourlyTrafficOut->setValue("price", $service["trafficOut"] * $priceMBOut);
    $hourlyTrafficOut->create();

    $dependencyInjector->getDatabase()->update("hourly_traffic_in_log",[
        "processed" => 1
    ],[
        "serviceid" => $serviceId
    ]);

    $dependencyInjector->getDatabase()->update("hourly_traffic_out_log",[
        "processed" => 1
    ],[
        "serviceid" => $serviceId
    ]);
}

print_r($trafficLogService);