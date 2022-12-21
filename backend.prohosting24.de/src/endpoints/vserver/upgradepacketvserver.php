<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["userid", "packetid", "calculate"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$badpackets = [9, 10, 11];

if (in_array($_POST["packetid"], $badpackets)) {
	$response->setfail(true, "Up/Downgrade ist für diesen Dienst nicht verfügbar.");
	return;
}
$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);

$oldvserver = new VServer($dependencyInjector);
$oldvserver->loadwithid($_POST["vserverid"]);

if ($oldvserver->getPacket() == null) {
	$response->setfail(true, "Packet Up/Downgrade ist nur für Packet KVM Server verfügbar.");
	return;
}

$serviceinfos = $masterdatabase->select("service_main", [
	"price",
	"expire_at",
	"discount",
    "id",
    "upgradeble",
], [
    "serviceid" => $_POST["vserverid"],
    "produktid" => 1,
]);
if ($serviceinfos[0]["upgradeble"] == 0) {
    $response->setfail(true, "Up/Downgrade ist für diesen Dienst nicht verfügbar.");
    return;
}
$serviceid = $serviceinfos[0]["id"];
$expire = strtotime($serviceinfos[0]["expire_at"]);
$now = time();
$daysleft = floor(($expire - $now) / (24 * 60 * 60));
if ($daysleft < 0) {
    $daysleft = 0;
}

$packetinfo = $masterdatabase->select("vserver_packets", [
    "cores",
    "memory",
    "disk",
    "price",
], [
    "id" => $_POST["packetid"],
]);
if (count($packetinfo) != 1) {
    $response->setfail(true, "Dieses Paket existiert nicht");
    return;
}
$packetinfo = $packetinfo[0];
$oldprice = $serviceinfos[0]["price"];
$pricechange = $serviceinfos[0]["price"] - $packetinfo["price"];

$pricechange = ($pricechange / 30) * $daysleft;
$pricechange = $pricechange * (1 - $serviceinfos[0]["discount"]);
$price = $packetinfo["price"];
$price = $price * (1 - $serviceinfos[0]["discount"]);

if($pricechange > 0){
    $pricechange = 0;
}
if ($_POST["calculate"] == 1) {
    $response->setresponse(["change" => (float) $pricechange, "monthly" => (float) $price]);
    return;
}

if ($pricechange < 0) {
    $moneyafter = $user->getGuthaben() - ($pricechange * -1);
    if ($moneyafter < 0) {
        $response->setfail(true, "Sie haben für dieses Produkt nicht genügend Guthaben");
        return;
    }
}

$user->changeguthaben($masterdatabase, $pricechange, "KVM Server Up/Downgrade");

logit($masterdatabase, "vserver_main", "id", $oldvserver->getId(), "Up/Downgrade - Kosten: " . $pricechange, $user->getID(), "0.0.0.0");

$proxmox = $oldvserver->openconnection();
$nodeinfo = $oldvserver->getNodeauth();
$info = [
    'cores' => $packetinfo["cores"],
    'memory' => $packetinfo["memory"],
];
$oldvserver->stop();
sleep(1);
$proxmox->create('/nodes/' . $nodeinfo["name"] . '/qemu/' . $oldvserver->getProxmoxid() . '/config', $info);

if ($oldvserver->getDisk() < $packetinfo["disk"]) {
    $proxmox->set('/nodes/' . $nodeinfo["name"] . '/qemu/' . $oldvserver->getProxmoxid() . '/resize', [
        "disk" => "scsi0",
        "size" => $packetinfo["disk"] . 'G',
    ]);
} else {
    $queue = new VServerQueue($dependencyInjector, null);
    $queue->setValue("serviceid", $_POST["vserverid"]);
    $queue->setValue("action", 2);
    $queue->setValue("nextid", "4,5,6,1");
    $queue->create();
}
sleep(1);
$oldvserver->start();


$masterdatabase->update("vserver_main", [
    "cores" => $packetinfo["cores"],
    "memory" => $packetinfo["memory"],
    "disk" => $packetinfo["disk"],
    "packet" => $_POST["packetid"],
], [
    "id" => $_POST["vserverid"],
]);

$masterdatabase->update("service_main", [
    "price" => $packetinfo["price"],
], [
    "serviceid" => $_POST["vserverid"],
]);

$response->setresponse(["change" => (float) $pricechange, "monthly" => (float) $price]);


$masterdatabase->insert("vserver_upgrade_log", [
    "vserverid" => $_POST["vserverid"],
    "cores" => $oldvserver->getCores(),
    "memory" => $oldvserver->getMemory(),
    "disk" => $oldvserver->getDisk(),
    "ips" => 1,
    "backups" => 1,
    "money" => $oldprice,
    "cores_after" => $packetinfo["cores"],
    "memory_after" => $packetinfo["memory"],
    "disk_after" => $packetinfo["disk"],
    "ips_after" => 1,
    "backups_after" => 1,
    "money_after" => $price,
], [
    "id" => $_POST["vserverid"],
]);
