<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid", "packageid", "imageid", "days"])) {
    $response->setfail(true, "Alle Felder müssen ausgefüllt sein");
    return;
}

if (!is_numeric($_POST["days"])) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}
if (strpos($_POST["days"], ',') !== false) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}
if ($_POST["days"] < 30) {
    $response->setfail(true, "Bitte eine Positive Zahl eingeben.");
    return;
}
if ($_POST["days"] > 365) {
    $response->setfail(true, "Maxmimal sind 365 Tage erlaubt.");
    return;
}
if (strpos($_POST["days"], '.') !== false) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}



$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);

$vserverpackage = new VServerPacket($masterdatabase, $config);

$packageinfo = $vserverpackage->getbyid($_POST["packageid"]);
if (!isset($packageinfo["price"])) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}
if ($packageinfo["active"] != 1) {
    $response->setfail(true, "Dieses Paket kann aktuell nicht bestellt werden.");
    return;
}
$price = $packageinfo["price"];
$discountedprice = $price;
if($packageinfo["normal"] == 1){
    if (isset($_POST["discountcode"])) {
        if ($_POST["discountcode"] != "") {
            $discounto = new Discount($dependencyInjector, $_POST["discountcode"], "code");
            $discounto->checkDiscount(100);
            $discountedprice = $discounto->getPrice($price);
            $discount = $discounto->getData()["amount"];
            $discounto->redeem();
            if ($discounto->getValue('type') == 2) {
                $discount = 0;
            }
        }
    }
}

$discountedprice = ($discountedprice / 30) * $_POST["days"];
$imageinfo = $masterdatabase->select("vserver_images", [
    "intern_id",
], [
    "id" => $_POST["imageid"],
]);
if (count($imageinfo) != 1) {
    $response->setfail(true, "Bitte wählen sie ein Betriebssystem aus.");
    return;
}

$imageid = $imageinfo[0]["intern_id"];

if(!$user->pay("KVM Server Kauf", $discountedprice, $dependencyInjector)){
    $response->setfail(true, $dependencyInjector->getLang()->getString("notenoughcredit"));
    return;
}
$paymentId = $masterdatabase->id();



$produktinfos = $masterdatabase->select("vserver_main", [
    "proxmoxid",
], [
    "LIMIT" => 1,
    "ORDER" => [
        "id" => "DESC",
    ],
]);
if (!isset($produktinfos[0]["proxmoxid"])) {
    $proxmoxid = 300;
} else {
    
    $proxmoxid = $masterdatabase->max("vserver_main", "proxmoxid", []) + 1;
}


$mac = '4e:65:06:' . implode(':', str_split(substr(md5(mt_rand()), 0, 6), 2));

$firtstpw = random_str(20);

$tmpNode = new Node($dependencyInjector);
$tmpNode->load_id($dependencyInjector->getDatabase(), 6);
$bestNode = $tmpNode->getbestnode();
$newNode = new VServerNode($dependencyInjector, $bestNode, "name");
$bestNode = $newNode->getValue("id");


$vserverdbid = $masterdatabase->insert("vserver_main", [
    "nodeid" => $bestNode,
    "cores" => $packageinfo["cores"],
    "memory" => $packageinfo["memory"],
    "disk" => $packageinfo["disk"],
    "firstpw" => $firtstpw,
    "trafficlimit" => 500,
    "mac" => $mac,
    "imageid" => $imageid,
    "proxmoxid" => $proxmoxid,
    "packet" => $_POST["packageid"],
]);
$vserverdbid = $masterdatabase->id();

if(!isset($discount)){
    $discount = 0;
}
$masterdatabase->insert("service_main", [
    "userid" => $user->getId(),
    "discount" => $discount,
    "produktid" => 1,
    "serviceid" => $vserverdbid,
    "price" => $price,
    "upgradeble" => 1,
    "expire_at" => date('Y-m-d H:i:s', strtotime('+' . $_POST["days"] . ' days')),
]);

$creditLog = new CreditLog($dependencyInjector, $paymentId);
$creditLog->setValue("serviceid", $masterdatabase->id());
$creditLog->update();
$serviceid = $masterdatabase->id();


$ip = new Ipv4($dependencyInjector,null);
$ip = $ip->getFreeIp();
$ip->setValue("serviceid", $serviceid);
$ip->update();

$ipv6 = new IpSubnetv6($dependencyInjector, null);
$ipv6->assignSubnet($serviceid);

$vserver = new \Ph24\service\VServer($dependencyInjector, $vserverdbid, "childid");
$vserver->install();
$mail = new Mail($masterdatabase, $config);

$mail->addmail("vserver_order", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "count_core" => $packageinfo["cores"], "count_ram" => $packageinfo["memory"] / 1024, "count_speicher" => $packageinfo["disk"], "count_ip" => 1]);

sendtodc('Neue VServer Packet Bestellung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Packet: ' . $_POST["packageid"] . '
Kosten: ' . $discountedprice . ' €', $config);


$cron = new VServerCron($dependencyInjector, null);
$cron->setValue('vserverid', $vserverdbid);
$cron->setValue('name', 'Backup');
$cron->setValue('cron_day_of_week', '*');
$cron->setValue('cron_month', '*');
$cron->setValue('cron_day_of_month', '*');
$cron->setValue('cron_hour', '0');
$cron->setValue('cron_minute', '0');
$cron->setValue('action', 'backup');
$cron->create();

$cron = new VServerCron($dependencyInjector, null);
$cron->setValue('vserverid', $vserverdbid);
$cron->setValue('name', 'fstrim');
$cron->setValue('cron_day_of_week', '0');
$cron->setValue('cron_month', '*');
$cron->setValue('cron_day_of_month', '*');
$cron->setValue('cron_hour', '6');
$cron->setValue('cron_minute', '0');
$cron->setValue('action', 'fstrim');
$cron->create();