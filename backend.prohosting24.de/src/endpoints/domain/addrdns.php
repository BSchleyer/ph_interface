<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["ip", "target"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

if (strpos($_POST["ip"], ':') !== false) {
    $ipv6 = true;
}

if($ipv6){
    $ip = new Ipv6($dependencyInjector, $_POST["ip"], "ip");
} else {
    $ip = new Ipv4($dependencyInjector, $_POST["ip"], "ip");
}

$ipFlip = flipip($_POST["ip"]);

$ns = new Nameserver($dependencyInjector);
$subnet = $ip->getSubnet();
if($ipv6){
    $subnetIp = flipip($subnet->getValue("netmask"));
    $subnetIp = substr($subnetIp, 32) . ".ip6.arpa";
} else {
    $subnetIp =  explode(".",flipip($subnet->getValue("gw")));
    unset($subnetIp[0]);
    $subnetIp = implode(".", $subnetIp) . ".in-addr.arpa";
}

if ($_POST["target"] == "in-addr.arpa") {
    if($ipv6){
        $_POST["target"] = $ipFlip . ".ip6.arpa";
    } else {
        $_POST["target"] = $ipFlip . ".in-addr.arpa";
    }
}
if($ipv6){
    $ipFlip = substr($ipFlip, 0, 31);
    $ns->addRecord($subnetIp,"PTR", $_POST["target"] . ".", 120,$ipFlip);
} else {
    $ipFlip =  explode(".",$ipFlip)[0];
    $ns->addRecord($subnetIp,"PTR", $_POST["target"] . ".", 120,$ipFlip);
}