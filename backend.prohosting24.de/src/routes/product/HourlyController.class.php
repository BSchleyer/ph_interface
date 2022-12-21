<?php


class HourlyController extends RouteTarget
{
    public function createVServer()
    {
        if(isset($_POST["packet"])){
            Functions::checkArray(["packet", "image", "userid", "name"],$_POST);
            $packet = true;
        } else {
            $packet = false;
            Functions::checkArray(["ipv4", "ipv6", "backupslots", "cores", "memory", "disk", "image", "userid", "name"],$_POST);
        }

        $info = new HourlyInfos($this->dependencyInjector, null);
        $info = $info->getAll(["userid" => $_POST["userid"]]);
        if (count($info) != 1) {
            $this->dependencyInjector->getResponse()->fail(403, "Sie sind nicht dafür freigeschaltet.");
        }
        $discount = $info[0]->getValue("discount");
        $usage = $info[0]->getLimits();

        $limits = new HourlyLimits($this->dependencyInjector, null);
        $limits = $limits->getAll(["infoid" => $info[0]->getValue("id")]);
        $limitsSorted = [];
        foreach ($limits as $limit){
            $limitsSorted[$limit->getValue("valueid")] = $limit;
        }

        if($packet) {
            $discount = 0;
        }

        $price = 0;
        $server = new VServerDatabase($this->dependencyInjector, null);
        if($packet){
            $packet = new HourlyPacket($this->dependencyInjector, $_POST["packet"]);
            $price = $packet->getValue("price");
            $values = $packet->getValues();
            foreach ($values as $value){
                $valueO = $value->getValues();
                if($valueO->getValue("variable") != "ipv4" && $valueO->getValue("variable") != "ipv6" && $valueO->getValue("variable") != "backupslots"){
                    $server->setValue($valueO->getValue("variable"), $value->getValue("value") * $valueO->getValue("multiply"));
                } else {
                    switch ($valueO->getValue("variable")){
                        case "ipv4":
                            $_POST["ipv4"] = $value->getValue("value");
                            break;
                        case "ipv6":
                            $_POST["ipv6"] = $value->getValue("value");
                            break;
                        case "backupslots":
                            $_POST["backupslots"] = $value->getValue("value");
                            break;
                    }
                }
            }
        } else {
            $values = new HourlyValues($this->dependencyInjector, null);
            $values = $values->getAll(["productid" => 1]);
            foreach ($values as $value){
                if(isset($limitsSorted[$value->getValue("id")])){
                    $newUsage = $usage[$value->getValue("variable")] + $_POST[$value->getValue("variable")];
                    if($newUsage >= $limitsSorted[$value->getValue("id")]->getValue("limit")){
                        $this->dependencyInjector->getResponse()->fail(403,"Sie haben Ihr Limit erreicht");
                    }
                }
                if($_POST[$value->getValue("variable")] > $value->getValue("max") || $_POST[$value->getValue("variable")] < $value->getValue("min")){
                    $this->dependencyInjector->getResponse()->fail(400, $value->getValue("variable") . " " . $value->getValue("min") . " " . $value->getValue("max"));
                }
                $price = $price + ($value->getValue("price") * $_POST[$value->getValue("variable")]);
                if($value->getValue("variable") != "ipv4" && $value->getValue("variable") != "ipv6" && $value->getValue("variable") != "backupslots"){
                    $server->setValue($value->getValue("variable"), $_POST[$value->getValue("variable")] * $value->getValue("multiply"));
                }
            }
        }
        $server->setValue("firstpw", random_str(20 , '0123456789abcdefghjkmnopqrstuvwxABCDEFGHJKMNOPQRSTUVWX'));
        $server->setValue("mac", '4e:65:06:' . implode(':', str_split(substr(md5(mt_rand()), 0, 6), 2)));
        $image  = new VServerImage($this->dependencyInjector, $_POST["image"]);
        $server->setValue("imageid", $image->getValue("intern_id"));
        $server->setValue("backupslots", $_POST["backupslots"]);
        if($packet){
            $server->setValue("packet", $_POST["packet"]);
        }
        $server->setValue("proxmoxid", $this->dependencyInjector->getDatabase()->max("vserver_main", "proxmoxid", []) + 1);
        $nodetmp = new Node($this->dependencyInjector);
        $server->setValue("nodeid", $nodetmp->getbestnode());
        $server->create();

        $service = new Service($this->dependencyInjector, null);
        $service->setValue("userid", $_POST["userid"]);
        $service->setValue("discount", $discount);
        $service->setValue("produktid", 1);
        $service->setValue("serviceid", $server->getValue("id"));
        $service->setValue("price", $price);
        $service->setValue("upgradeble", 1);
        $service->setValue("name", htmlspecialchars($_POST["name"]));
        $service->setValue("expire_at", date('Y-m-d H:i:s', strtotime('+1 hours')));
        $service->setValue("hourly", 1);
        $service->create();
        $serverOld = new VServer($this->dependencyInjector);
        $serverOld->loadwithid($server->getValue("id"));

        for ($i = 1;$_POST["ipv4"] >= $i; $i++){
            $serverOld->addipv4adress();
        }

        for ($e = 1;$_POST["ipv6"] >= $e; $e++){
            $serverOld->addipv6subnet();
        }

        $queue = new VServerQueue($this->dependencyInjector, null);
        $queue->setValue("serviceid", $server->getValue("id"));
        $queue->setValue("action", 5);
        $queue->setValue("nextid", "7,6,1");
        $queue->create();
        $service->calcHourly();
    }

    public function deleteVServer()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new VServerDatabase($this->dependencyInjector, $_POST["id"]);
        $service = $server->getService();
        $server->deleteNow();
        $service->deleteNow();
    }

    public function calcService()
    {
        Functions::checkArray(["id"],$_POST);
        $service = new Service($this->dependencyInjector, $_POST["id"]);
        $service->calcHourly();
    }

    public function calcServiceDisplay()
    {
        Functions::checkArray(["userid", "date"], $_POST);
        $date = new DateTime($_POST["date"]);
        $timeStampFirst = $date->format("Y") . "-" . $date->format("m") . "-01";
        $date->modify( 'first day of next month' );
        $timeStampLast = $date->format("Y") . "-" . $date->format("m") . "-01";
        $service =  new Service($this->dependencyInjector, null);
        $statement = "SELECT * FROM service_main WHERE userid = '" . $_POST["userid"] . "' AND hourly = 1 and delete_at IS NULL or userid = '" . $_POST["userid"] . "' AND hourly = 1 and delete_at > '" . $timeStampFirst . "';";
        $result = $this->dependencyInjector->getDatabase()->query($statement)->fetchAll();
        $return = [];
        $return["list"] = [];
        $priceSum = 0;
        $value = new HourlyValues($this->dependencyInjector, null);
        $hourlyValues = $value->getAll(["productid" => 1], true);
        $trafficList = [];
        foreach ($result as $service){
            $log = new HourlyLog($this->dependencyInjector, null);
            $logs = $log->getAll([
                "serviceid" => $service["id"],
                "created_on[>]" => $timeStampFirst,
                "created_on[<]" => $timeStampLast,
                "paid" => 0
            ], true);
            $logIds = [];
            $price = 0;
            foreach ($logs as $log){
                $logIds[] = $log["id"];
                $price += $log["price"];
            }
            if($price != 0){
                $logValue = new HourlyLogValues($this->dependencyInjector, null);
                $logValues = $logValue->getAll(["logid" => $logIds], true);
                $valuesOrder = [];
                $counter = [];
                foreach ($hourlyValues as $value){
                    $valuesOrder[$value["id"]] = $value;
                    $counter[$value["variable"]] = 0;
                }
                foreach ($logValues as $value){
                    $counter[$valuesOrder[$value["valueid"]]["variable"]] += $value["count"];
                }

                $displayName = $service["id"];

                if($service["name"] != ""){
                    $displayName .= "(" . htmlspecialchars($service["name"]) . ")";
                }

                $return["list"][] =  [
                    "id" => $displayName,
                    "price" => str_replace(".",",",round($price, 2)),
                    "count" => $counter,
                    "usage" => count($logIds)
                ];
            }
            $hourlyTraffic = new HourlyTrafficIn($this->dependencyInjector, null);
            $hourlyTrafficIn = $hourlyTraffic->getAll(["serviceid" => $service["id"], "paid" => 0]);

            foreach ($hourlyTrafficIn as $traffic){
                $date = new DateTime($traffic->getValue("created_on"));
                $date = $date->format("d") . "." . $date->format("m") . "." . $date->format("Y");
                if(!isset($trafficList[$date])){
                    $trafficList[$date] = [];
                    $trafficList[$date]["price"] = 0;
                    $trafficList[$date]["gb"] = 0;
                    $trafficList[$date]["date"] = $date;
                }
                $trafficList[$date]["price"] += $traffic->getValue("price");
                $trafficList[$date]["gb"] += $traffic->getValue("count");
                $price += $traffic->getValue("price");
            }

            $hourlyTraffic = new HourlyTrafficOut($this->dependencyInjector, null);
            $hourlyTrafficOut = $hourlyTraffic->getAll(["serviceid" => $service["id"], "paid" => 0]);

            foreach ($hourlyTrafficOut as $traffic){
                $date = new DateTime($traffic->getValue("created_on"));
                $date = $date->format("d") . "." . $date->format("m") . "." . $date->format("Y");
                if(!isset($trafficList[$date])){
                    $trafficList[$date] = [];
                    $trafficList[$date]["price"] = 0;
                    $trafficList[$date]["gb"] = 0;
                    $trafficList[$date]["date"] = $date;
                }
                $trafficList[$date]["price"] += $traffic->getValue("price");
                $trafficList[$date]["gb"] += $traffic->getValue("count");
                $price += $traffic->getValue("price");
            }

            $priceSum += round($price, 2);
        }
        $trafficReturn = [];
        foreach ($trafficList as $traffic){
            $trafficReturn[] = $traffic;
        }
        $return["traffic"] = $trafficReturn;
        $return["sum"] = str_replace(".",",",round($priceSum, 2));
        $return["date"] = date("t.m.Y", strtotime($_POST["date"]));
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function upDowngrade()
    {
        if(isset($_POST["packet"])){
            Functions::checkArray(["serviceid", "packet"], $_POST);
            $packet = true;
        } else {
            $packet = false;
            Functions::checkArray(["serviceid", "cores", "backupslots", "ipv4", "ipv6", "disk", "memory"], $_POST);
        }
        $service = new Service($this->dependencyInjector, $_POST["serviceid"]);

        if($service->getValue("hourly") != 1){
            $this->dependencyInjector->getResponse()->fail(400, "...");
        }

        $server = new VServerDatabase($this->dependencyInjector, $service->getValue("serviceid"));

        if($server->getValue("packet") != "packet"){
            if(!$packet){
                $this->dependencyInjector->getResponse()->fail(400, "...");
            }
        }

        $serverOld = new VServer($this->dependencyInjector);
        $serverOld->loadwithid($server->getValue("id"));
        $ips = $serverOld->getips();

        $values = new HourlyValues($this->dependencyInjector, null);
        $values = $values->getAll(["productid" => 1]);
        $price = 0;
        $diskOld = $server->getValue("disk");

        if($packet){
            $packet = new HourlyPacket($this->dependencyInjector, $_POST["packet"]);
            $price = $packet->getValue("price");
            $values = $packet->getValues();
            foreach ($values as $value){
                $valueO = $value->getValues();
                if($valueO->getValue("variable") != "ipv4" && $valueO->getValue("variable") != "ipv6" && $valueO->getValue("variable") != "backupslots"){
                    $server->setValue($valueO->getValue("variable"), $value->getValue("value") * $valueO->getValue("multiply"));
                } else {
                    switch ($valueO->getValue("variable")){
                        case "ipv4":
                            $_POST["ipv4"] = $value->getValue("value");
                            break;
                        case "ipv6":
                            $_POST["ipv6"] = $value->getValue("value");
                            break;
                        case "backupslots":
                            $_POST["backupslots"] = $value->getValue("value");
                            break;
                    }
                }
            }
        } else {
            foreach ($values as $value){
                if($_POST[$value->getValue("variable")] > $value->getValue("max") || $_POST[$value->getValue("variable")] < $value->getValue("min")){
                    $this->dependencyInjector->getResponse()->fail(400, $value->getValue("variable") . " " . $value->getValue("min") . " " . $value->getValue("max"));
                }
                $price = $price + ($value->getValue("price") * $_POST[$value->getValue("variable")]);
                if($value->getValue("variable") != "ipv4" && $value->getValue("variable") != "ipv6" && $value->getValue("variable") != "backupslots"){
                    $server->setValue($value->getValue("variable"), $_POST[$value->getValue("variable")] * $value->getValue("multiply"));
                }
            }
        }
        if(count($ips[0]) > $_POST["ipv4"]){
            $this->dependencyInjector->getResponse()->fail(400, "Ipv4 Downgrade nicht möglich.");
        }

        if(count($ips[1]) > $_POST["ipv6"]){
            $this->dependencyInjector->getResponse()->fail(400, "Ipv6 Downgrade nicht möglich.");
        }

        for ($i = count($ips[0]) + 1;$_POST["ipv4"] >= $i; $i++){
            $serverOld->addipv4adress();
        }

        for ($e = count($ips[1]) + 1;$_POST["ipv6"] >= $e; $e++){
            $serverOld->addipv6subnet();
        }

        $serverOld->loadwithid($server->getValue("id"));
        $server->setValue("backupslots", $_POST["backupslots"]);
        $server->update();

        if($diskOld > $_POST["disk"]){
            $queue = new VServerQueue($this->dependencyInjector, null);
            $queue->setValue("serviceid", $server->getValue("id"));
            $queue->setValue("action", 2);
            $queue->setValue("nextid", "4,5,6,1");
            $queue->create();
        } else {
            $queue = new VServerQueue($this->dependencyInjector, null);
            $queue->setValue("serviceid", $server->getValue("id"));
            $queue->setValue("action", 8);
            $queue->setValue("nextid", "2,1");
            $queue->create();
        }
        $service->setValue("price", $price);
        $service->setValue("expire_at", date('Y-m-d H:i:s', strtotime('+1 hours')));
        $service->update();
        $service->calcHourly();
    }

}