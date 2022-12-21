<?php


    public function getDescription(): string
    {
        $ipinfo = $this->getips();

        $ipv4Info = "";

        foreach ($ipinfo[0] as $ip){
            $ipv4Info .= ", " . $ip->getValue("ip");
        }

        $description = "Userid: " . $this->getUserid() . "<br>";
        $description .= "ServiceID: " . $this->getServiceid() . "<br>";
        $description .= "ServerID: " . $this->getId() . "<br>";
        $description .= "IP: " . $ipv4Info . "<br>";
        $description .= "IPv6: " . $ipinfo[1][0]->getValue("netmask") . "/64 <br>";
        return $description;
    }
}
