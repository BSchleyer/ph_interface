<?php


class HourlyInfos extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_infos", $dependencyInjector, $value, $key);
    }

    public function getLimits()
    {
        $serviceinfos = $this->dependencyInjector->getDatabase()->select("service_main", [
            "[>]vserver_main" => ["serviceid" => "id"],
        ],[
            "service_main.id",
            "vserver_main.cores",
            "vserver_main.memory",
            "vserver_main.disk",
            "vserver_main.backupslots",
        ], [
            "service_main.delete_done" => 0,
            "service_main.hourly" => 1,
            "service_main.userid" => $this->getValue("userid")
        ]);
        $serviceIds = [];
        $infos = [];
        $infos["cores"] = 0;
        $infos["memory"] = 0;
        $infos["disk"] = 0;
        $infos["backupslots"] = 0;
        foreach ($serviceinfos as $service){
            $infos["cores"] += $service["cores"];
            $infos["memory"] += $service["memory"];
            $infos["disk"] += $service["disk"];
            $infos["backupslots"] += $service["backupslots"];
            $serviceIds[] = $service["id"];
        }

        $infos["memory"] = $infos["memory"] / 1024;

        $ipv4Count = new Ipv4($this->dependencyInjector, null);
        $infos["ipv4"] = count($ipv4Count->getAll(["serviceid" => $serviceIds]));

        $ipv6Count = new IpSubnetv6($this->dependencyInjector, null);
        $infos["ipv6"] = count($ipv6Count->getAll(["serviceid" => $serviceIds]));
        return $infos;
    }
}