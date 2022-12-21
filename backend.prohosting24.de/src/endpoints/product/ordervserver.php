<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid", "cores", "memory", "disk", "ip", "imageid", "days"])) {
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


$tmpNode = new Node($dependencyInjector);
$tmpNode->load_id($dependencyInjector->getDatabase(), 6);
$bestNode = $tmpNode->getbestnode();
$newNode = new VServerNode($dependencyInjector, $bestNode, "name");
$bestNode = $newNode->getValue("id");


$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);
$price = 0;

$coreupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["cores"],
    "upgradeid" => 1,
]);
if (count($coreupgradepack) != 1) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}

$price += $coreupgradepack[0]["price"];
$cores = $coreupgradepack[0]["data"];


$memoryupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["memory"],
    "upgradeid" => 2,
]);
if (count($memoryupgradepack) != 1) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}
$price += $memoryupgradepack[0]["price"];
$memory = $memoryupgradepack[0]["data"];

$diskupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["disk"],
    "upgradeid" => 3,
]);
if (count($diskupgradepack) != 1) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}
$price += $diskupgradepack[0]["price"];
$disk = $diskupgradepack[0]["data"];

$ipsupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["ip"],
    "upgradeid" => 4,
]);
if (count($ipsupgradepack) != 1) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}
$price += $ipsupgradepack[0]["price"];
$ips = $ipsupgradepack[0]["data"];


$produktinfos = $masterdatabase->select("product_main", [
    "typid",
    "name",
    "price",
], [
    "id" => 1,
]);


$price += $produktinfos[0]["price"];
$normalprice = $price;
$discountedprice = $price;
if (isset($_POST["discountcode"])) {
    if ($_POST["discountcode"] != "") {
        $discounto = new Discount($dependencyInjector, $_POST["discountcode"], "code");
        $discounto->checkDiscount(1);
        $discountedprice = $discounto->getPrice($price);
        $price = $discountedprice;
        $discount = $discounto->getData()["amount"];
        $discounto->redeem();
        if ($discounto->getValue('type') == 2) {
            $discount = 0;
        }
    }
} else {
    $discount = 0;
}
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
$nonStackedPrice = $normalprice;
$price = ($price / 30) * $_POST["days"];

if(!$user->pay("KVM Server Kauf", $price, $dependencyInjector)){
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

$firtstpw = random_str(20 , '0123456789abcdefghjkmnopqrstuvwxABCDEFGHJKMNOPQRSTUVWX');


$vserverdbid = $masterdatabase->insert("vserver_main", [
    "nodeid" => $bestNode,
    "cores" => $cores,
    "memory" => $memory,
    "disk" => $disk,
    "firstpw" => $firtstpw,
    "trafficlimit" => 500,
    "mac" => $mac,
    "imageid" => $imageid,
    "proxmoxid" => $proxmoxid,
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
    "price" => $nonStackedPrice,
    "upgradeble" => 1,
    "expire_at" => date('Y-m-d H:i:s', strtotime('+' . $_POST["days"] . ' days')),
]);
$serviceid = $masterdatabase->id();

$creditLog = new CreditLog($dependencyInjector, $paymentId);
$creditLog->setValue("serviceid", $masterdatabase->id());
$creditLog->update();


for ($i = 0; $i < $ips; $i++) {
    $ip = new Ipv4($dependencyInjector,null);
    $ip = $ip->getFreeIp();
    $ip->setValue("serviceid", $serviceid);
    $ip->update();
}

$ipv6 = new IpSubnetv6($dependencyInjector, null);
$ipv6->assignSubnet($serviceid);

$vserver = new \Ph24\service\VServer($dependencyInjector, $vserverdbid, "childid");
$vserver->install();
$mail = new Mail($masterdatabase, $config);
$mail->addmail("vserver_order", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "count_core" => $cores, "count_ram" => $memory / 1024, "count_speicher" => $disk, "count_ip" => $ips]);
sendtodc('Neue VServer Bestellung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Kosten: ' . $price . ' €', $config);


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