<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$service = $masterdatabase->select("service_main", [
    "id",
], [
    "serviceid" => $_POST["id"],
    "produktid" => 1,
]);
if (count($service) != 1) {
    $response->setfail(true, "Service nicht gefunden.");
    return;
}
$ips = new Ipv4($dependencyInjector,null);
$ips = $ips->getAll(["serviceid" => $service[0]["id"]]);

$ipv6 = new IpSubnetv6($dependencyInjector, null);
$ipv6Subnet = $ipv6->getAll(["serviceid" => $service[0]["id"]]);


$ns = new Nameserver($dependencyInjector);

$ipReturn = [];

foreach ($ips as $keyip => $ip) {
    $tmp = [];
    $ip->loadSubnet();
    $subnet = $ip->getSubnet();
    $flipip = flipip($ip->getValue("ip"));
    $info = $ns->getSpecifiedRecord($subnet->getDNSDomain(),$flipip . ".in-addr.arpa.","PTR");

    if (isset($info[0]["content"])) {
        $tmp["rdns"] = htmlspecialchars($info[0]["content"]);
    } else {
        $tmp["rdns"] = $flipip . ".in-addr.arpa";
    }
    $tmp["gw"] = $subnet->getValue("gw");
    $tmp["netmask"] = $subnet->getValue("netmask");
    $tmp["ip"] = $ip->getValue("ip");
    $tmp["ipv6"] = false;
    $ipReturn[] = $tmp;
}

unset($ip);

$nextIpv6 = "0:0:0:1";
foreach ($ipv6Subnet as $subnet) {
    $tmp = [];
    
    $tmp["rdns"] = "";
    $tmp["gw"] = $subnet->getValue("gw");
    $tmp["ip"] = $subnet->getNetmask();
    $tmp["netmask"] = "";
    $tmp["ipv6"] = false;
    $tmp["left"] = implode(":",array_slice(explode(":", $subnet->getValue("netmask")),0 ,4)) . ":";
    $ipReturn[] = $tmp;
    foreach ($subnet->getIps() as $ip){
        $tmpp = [];
        $flipip = flipip($ip->getValue("ip"));
        $info = $ns->getSpecifiedRecord($subnet->getDNSDomain(),$flipip . ".ip6.arpa.","PTR");
        if (isset($info[0]["content"])) {
            $tmpp["rdns"] = htmlspecialchars($info[0]["content"]);
        } else {
            $tmpp["rdns"] = $flipip . ".ip6.arpa";
        }
        $tmpp["gw"] = $subnet->getValue("gw");
        $tmpp["netmask"] = $subnet->getValue("netmask");
        $tmpp["ip"] = $ip->getValue("ip");
        $tmpp["ipv6"] = true;
        $ipReturn[] = $tmpp;
        $binaryIpV6In = inet_pton($ip->getValue("ip"));
        $binaryIpV6Out = binaryIncrement($binaryIpV6In);
        $nextIpv6 = str_replace($tmp["left"], "" ,inet_ntop($binaryIpV6Out));
        $nextIpv6Array = explode(":",$nextIpv6);
        if(count($nextIpv6Array) == 2){
            $nextIpv6 = "0:0:0:" . $nextIpv6Array[1];
        }
        if(count($nextIpv6Array) == 3){
            $nextIpv6 = "0:0:" . $nextIpv6Array[1].":". $nextIpv6Array[2];
        }
        if(count($nextIpv6Array) == 4){
            $nextIpv6 = "0:" . $nextIpv6Array[1].":". $nextIpv6Array[2].":". $nextIpv6Array[3];
        }
        if(count($nextIpv6Array) == 5){
            $nextIpv6 = $nextIpv6Array[1].":". $nextIpv6Array[2].":". $nextIpv6Array[3].":". $nextIpv6Array[4];
        }
    }
}

$response->setresponse(["array" => $ipReturn, "nextIpv6" => $nextIpv6]);
