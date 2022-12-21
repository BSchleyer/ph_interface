<?php


class Service extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("service_main", $dependencyInjector, $value, $key);
    }

    public function getServiceByServiceId($serviceId, $productId)
    {
        return $this->getAll(["serviceid" => $serviceId,"produktid" => $productId]);
    }

    public function deleteNow()
    {
        $ip = new Ipv4($this->dependencyInjector, null);
        $ip->freeIpsByServive($this->getValue("id"));
        $ip = new IpSubnetv6($this->dependencyInjector, null);
        $ip->freeSubnet($this->getValue("id"));
        $this->setValue("delete_done", 1);
        $this->setValue("expire_email", 1);
        $this->setValue("hide", 1);
        $this->setValue("expire_at", date('Y-m-d H:i:s', strtotime('-1 hours')));
        $this->setValue("delete_at", date('Y-m-d H:i:s', strtotime('-1 hours')));
        $this->update();
    }

    public function getRemainingDays()
    {
        $expire = strtotime($this->getValue("expire_at"));
        $now = time();
        return floor(($expire - $now) / (24 * 60 * 60));
    }

    public function getPrice()
    {
        $price = $this->getValue("price");
        $discount = $this->getValue("discount");

        return $price * (1 - $discount);
    }

    public function getPricePerDay()
    {
        $price = $this->getPrice();
        return $price / 30;
    }

    public function calcHourly()
    {
        $price = $this->getPrice();
        $hourlyLog = new HourlyLog($this->dependencyInjector, null);
        $hourlyLog->setValue("serviceid", $this->getValue("id"));
        $hourlyLog->setValue("price", $price);
        $hourlyLog->create();

        $vserver = new VServerDatabase($this->dependencyInjector, $this->getValue("serviceid"));

        $values = new HourlyValues($this->dependencyInjector, null);
        $values = $values->getAll(["productid" => 1]);
        foreach ($values as $value){
            $tmp = new HourlyLogValues($this->dependencyInjector, null);
            $tmp->setValue("logid", $hourlyLog->getValue("id"));
            $tmp->setValue("valueid", $value->getValue("id"));
            if($value->getValue("variable") != "ipv4" && $value->getValue("variable") != "ipv6") {
                $tmp->setValue("count", $vserver->getValue($value->getValue("variable")) / $value->getValue("multiply"));
            } else {
                switch ($value->getValue("variable")){
                    case 'ipv4':
                        $tmp->setValue("count", $this->getIpv4Count());
                        break;
                    case 'ipv6':
                        $tmp->setValue("count", $this->getIpv6Count());
                        break;
                }
            }
            $tmp->create();
        }
    }

    public function getIpv4Count()
    {
        $ip = new Ipv4($this->dependencyInjector, null);
        return count($ip->getAll(["serviceid" => $this->getValue("id")]));
    }

    public function getIpv6Count()
    {
        $ip = new IpSubnetv6($this->dependencyInjector, null);
        return count($ip->getAll(["serviceid" => $this->getValue("id")]));
    }
}
