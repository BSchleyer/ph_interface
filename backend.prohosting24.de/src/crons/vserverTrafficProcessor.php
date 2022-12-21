<?php


$vserverTrafficIn = new TrafficInLog($dependencyInjector, null);



$vserverTrafficIn = $vserverTrafficIn->getAll(["processed" => 0, "LIMIT" => 1, "ORDER" => ["id" => "ASC"]]);
if(count($vserverTrafficIn) == 1) {
    $data = $vserverTrafficIn[0]->getValue('created_on');
    if(date('Y-m-d H', strtotime($data)) != date('Y-m-d H', time())) {
        $vserverTrafficIn = new TrafficInLog($dependencyInjector, null);
        $vserverTrafficIn = $vserverTrafficIn->getAll(["processed" => 0, "created_on[>]" => date('Y-m-d H:0:0', strtotime($data)), "created_on[<]" => date('Y-m-d H:59:59', strtotime($data))], true);
        $vserverTrafficList = [];

        foreach ($vserverTrafficIn as $traffic) {
            if (!isset($vserverTrafficList[$traffic["proxmoxid"]])) {
                $vserverTrafficList[$traffic["proxmoxid"]] = 0;
            }
            $vserverTrafficList[$traffic["proxmoxid"]] += $traffic["count"];
        }

        foreach ($vserverTrafficList as $vserverid => $trafficEntry) {
            $vserverTrafficIn = new TrafficHourlyInLog($dependencyInjector, null);
            $vserverTrafficIn->setValue('proxmoxid', $vserverid);
            $vserverTrafficIn->setValue('count', $trafficEntry);
            $vserverTrafficIn->setValue('created_on', date('Y-m-d H:0:0', strtotime($data)));
            $vserverTrafficIn->create();
        }

        $vserverTrafficIn = new TrafficInLog($dependencyInjector, null);
        $vserverTrafficIn->massUpdate(["processed" => 1], ["created_on[>]" => date('Y-m-d H:0:0', strtotime($data)), "created_on[<]" => date('Y-m-d H:59:59', strtotime($data))]);
    }
}

$vserverTrafficOut = new TrafficOutLog($dependencyInjector, null);



$vserverTrafficOut = $vserverTrafficOut->getAll(["processed" => 0, "LIMIT" => 1, "ORDER" => ["id" => "ASC"]]);

if(count($vserverTrafficOut) == 1) {
    $data = $vserverTrafficOut[0]->getValue('created_on');
    if(date('Y-m-d H', strtotime($data)) != date('Y-m-d H', time())) {

        $vserverTrafficOut = new TrafficOutLog($dependencyInjector, null);
        $vserverTrafficOut = $vserverTrafficOut->getAll(["processed" => 0, "created_on[>]" => date('Y-m-d H:0:0', strtotime($data)), "created_on[<]" => date('Y-m-d H:59:59', strtotime($data))], true);
        $vserverTrafficList = [];

        foreach ($vserverTrafficOut as $traffic) {
            if (!isset($vserverTrafficList[$traffic["proxmoxid"]])) {
                $vserverTrafficList[$traffic["proxmoxid"]] = 0;
            }
            $vserverTrafficList[$traffic["proxmoxid"]] += $traffic["count"];
        }

        foreach ($vserverTrafficList as $vserverid => $trafficEntry) {
            $vserverTrafficOut = new TrafficHourlyOutLog($dependencyInjector, null);
            $vserverTrafficOut->setValue('proxmoxid', $vserverid);
            $vserverTrafficOut->setValue('count', $trafficEntry);
            $vserverTrafficOut->setValue('created_on', date('Y-m-d H:0:0', strtotime($data)));
            $vserverTrafficOut->create();
        }

        $vserverTrafficOut = new TrafficOutLog($dependencyInjector, null);
        $vserverTrafficOut->massUpdate(["processed" => 1], ["created_on[>]" => date('Y-m-d H:0:0', strtotime($data)), "created_on[<]" => date('Y-m-d H:59:59', strtotime($data))]);
    }
}


$vserverTrafficIn = new TrafficHourlyInLog($dependencyInjector, null);
$vserverTrafficInData = $vserverTrafficIn->rawQuerry("SELECT sum(count), proxmoxid FROM ph24.vserver_traffic_hourly_in_log where created_on > '" . date('Y-m-01 00:00:00', time()) . "' and created_on < '" . date('Y-m-t 23:59:59', time()) . "' group by proxmoxid");

$vserverTrafficOut = new TrafficHourlyOutLog($dependencyInjector, null);
$vserverTrafficOutData = $vserverTrafficOut->rawQuerry("SELECT sum(count), proxmoxid FROM ph24.vserver_traffic_hourly_out_log where created_on > '" . date('Y-m-01 00:00:00', time()) . "' and created_on < '" . date('Y-m-t 23:59:59', time()) . "' group by proxmoxid");


$vserverTrafficList = [];

foreach ($vserverTrafficInData as $entry){
    if(!isset($vserverTrafficList[$entry["proxmoxid"]])){
        $vserverTrafficList[$entry["proxmoxid"]] = [
            "total" => 0,
            "in" => 0,
            "out" => 0
        ];
    }
    $vserverTrafficList[$entry["proxmoxid"]]["total"] += $entry["sum"];
    $vserverTrafficList[$entry["proxmoxid"]]["in"] += $entry["sum"];
}

foreach ($vserverTrafficOutData as $entry){
    if(!isset($vserverTrafficList[$entry["proxmoxid"]])){
        $vserverTrafficList[$entry["proxmoxid"]] = [
            "total" => 0,
            "in" => 0,
            "out" => 0
        ];
    }
    $vserverTrafficList[$entry["proxmoxid"]]["total"] += $entry["sum"];
    $vserverTrafficList[$entry["proxmoxid"]]["out"] += $entry["sum"];
}

foreach ($vserverTrafficList as $proxmoxid => $entry) {
    $sendtoDiscord = false;
    for ($i = 1000000; $i < $entry["total"]; $i += 1000000){
        $trafficNotifyLog = new TrafficNotifyLog($dependencyInjector, null);
        $trafficNotifyLog = $trafficNotifyLog->getAll(["proxmoxid" => $proxmoxid, "count" => $i, "created_on[>]" => date('Y-m-01 00:00:00', time()), "created_on[<]" => date('Y-m-t 23:59:59', time())]);
        if(count($trafficNotifyLog) == 0){
            $sendtoDiscord = true;
            $trafficNotifyLog = new TrafficNotifyLog($dependencyInjector, null);
            $trafficNotifyLog->setValue("proxmoxid", $proxmoxid);
            $trafficNotifyLog->setValue("count", $i);
            $trafficNotifyLog->create();
        }
    }
    if($sendtoDiscord) {
        Functions::sendDataToDiscordFeed("VServer Traffic Warnung","Der VServer " . $proxmoxid . " hat im aktuellen Monat bereits " . $entry["total"] / 1000000 . " TB Traffic verbraucht","",[[
            "name" => "In",
            "value" => $entry["in"] / 1000000 . " TB"
        ],[
            "name" => "Out",
            "value" => $entry["out"] / 1000000 . " TB"
        ]],'#B03A2E');
    }
}