<?php


class IpSubnetv6 extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ip_subnet_v6", $dependencyInjector, $value, $key);
    }

    public function getIps()
    {
        $tmp = new Ipv6($this->dependencyInjector,null);
        return $tmp->getAll(["subnet" => $this->getValue("id"), "ORDER" => ["id" => "ASC"]]);
    }

    public function getDNSDomain()
    {
        $subnetIp = flipip($this->getValue("netmask"));
        return substr($subnetIp, 32) . ".ip6.arpa";
    }

    public function checkFirstIp()
    {
        $ips = $this->getIps();
        foreach ($ips as $ip){
            if($ip->getValue("ip") == $this->getValue("netmask")){
                return;
            }
        }
        $this->createIp($this->getValue("netmask"));
    }

    public function createIp($ip)
    {
        $ipv6 = new Ipv6($this->dependencyInjector,null);
        $ipv6->setValue("ip", $ip);
        $ipv6->setValue("mac", " ");
        $ipv6->setValue("subnet", $this->getValue("id"));
        $ipv6->create();
    }

    public function getFreeSubnet()
    {
        $tmp = $this->getAll(["serviceid" => null]);
        if (count($tmp) != 0) {
            return $tmp[0];
        }
        $last = $this->getAll(["ORDER" => ["id" => "DESC", "LIMIT" => 1]])[0];

        $ipv6 = $last->getValue("netmask");
        $ipv6Array = explode(":", $ipv6);
        $ipv6Array[3] = dechex(hexdec($ipv6Array[3]) + 1);
        $newIpv6 = new IpSubnetv6($this->dependencyInjector, null);
        $newIpv6->setValue("netmask", implode(":", $ipv6Array));
        $newIpv6->setValue("gw", "fe80::1");
        $newIpv6->setValue("serviceid", null);
        $newIpv6->create();
        $ns = new Nameserver($this->dependencyInjector);
        $ns->adddomain($newIpv6->getDNSDomain());
        return $newIpv6;
    }

    public function getDomainName()
    {
        return substr(flipip($this->getValue("netmask")), 32) . ".ip6.arpa";
    }

    public function getNetmaskOnly()
    {
        $ipv6Array = explode(":", $this->getValue("netmask"));
        return implode(":", array_slice($ipv6Array,0 ,4));
    }

    public function getNetmask()
    {
        $ipv6Array = explode(":", $this->getValue("netmask"));
        return implode(":", array_slice($ipv6Array,0 ,4)) . "::/64";
    }

    public function assignSubnet($serviceid)
    {
        $subnet = $this->getFreeSubnet();
        $subnet->setValue("serviceid", $serviceid);
        $subnet->update();
    }

    public function freeSubnet($serviceid)
    {
        $subnetList = $this->getAll(["serviceid" => $serviceid]);
        foreach ($subnetList as $subnet){
            $subnet->deleteIps();
            $subnet->setValue("serviceid", null);
            $subnet->update();
        }
    }

    public function getSubnetsByServive($serviceId, $json = false)
    {
        return $this->getAll(["serviceid" => $serviceId], $json);
    }

    public function deleteIps()
    {
        $ips = new Ipv6($this->dependencyInjector, null);
        $ips = $ips->getAll(["subnet" => $this->getValue("id")]);
        foreach ($ips as $ip){
            $ip->loadSubnet();
            $ip->resetRdns();
        }
    }
}