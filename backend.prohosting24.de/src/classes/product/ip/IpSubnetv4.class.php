<?php


class IpSubnetv4 extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ip_subnet_v4", $dependencyInjector, $value, $key);
    }

    public function createIps()
    {
        $ipsplit = explode(".",$this->getValue("gw"));
        $first3 = $ipsplit[0].".".$ipsplit[1].".".$ipsplit[2].".";
        for ($i=2; $i < 255; $i++) {
            $this->dependencyInjector->getDatabase()->insert("ip_v4", [
                "ip" => $first3.$i,
                "serviceid" => null,
                "mac" => null,
                "subnet" => $this->getValue("id"),
            ]);
        }
    }

    public function getDNSDomain()
    {
        $subnetIp =  explode(".",flipip($this->getValue("gw")));
        unset($subnetIp[0]);
        return implode(".", $subnetIp) . ".in-addr.arpa";
    }

    public function getIps()
    {
        $tmp = new Ipv4($this->dependencyInjector,null);
        return $tmp->getAll(["subnet" => $this->getValue(["id"])]);
    }
}
