<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "cores", "memory", "disk", "vserverid", "slots", "calculate"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);

$oldvserver = new VServer($dependencyInjector);
$oldvserver->loadwithid($_POST["vserverid"]);

if ($oldvserver->getPacket() != null) {
	$response->setfail(true, "Custom Up/Downgrade ist nur für Normale vServer verfügbar");
	return;
}

$serviceinfos = $masterdatabase->select("service_main", [
	"price",
	"discount",
	"expire_at",
    "upgradeble",
    "id",
], [
    "serviceid" => $_POST["vserverid"],
    "produktid" => 1,
]);
if(count($serviceinfos) != 1){
    $response->setfail(true, "Invalid");
    return;
}
$oldprice = $serviceinfos[0]["price"];
$serviceid = $serviceinfos[0]["id"];


if ($serviceinfos[0]["upgradeble"] == 0) {
    $response->setfail(true, "Up/Downgrade ist für diesen Dienst nicht verfügbar.");
    return;
}

$expire = strtotime($serviceinfos[0]["expire_at"]);
$now = time();
$daysleft = floor(($expire - $now) / (24 * 60 * 60));
if ($daysleft < 0) {
    $daysleft = 0;
}

$baseprice = $masterdatabase->select("product_main", [
    "price",
], [
    "id" => 1,
]);

$price = $baseprice[0]["price"];
$pricechange = 0;

$coreupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["cores"],
    "upgradeid" => 1,
]);
if(count($coreupgradepack) != 1){
    $response->setfail(true, "Invalid");
    return;
}

$price = $price + $coreupgradepack[0]["price"];
$cores = $coreupgradepack[0]["data"];
$change = false;
if ($cores != $oldvserver->getCores()) {
    $change = true;
    $coreolddata = $masterdatabase->select("product_upgrade_values", [
        "price",
        "name",
        "data",
    ], [
        "data" => $oldvserver->getCores(),
        "upgradeid" => 1,
    ]);
    if ($cores < $oldvserver->getCores()) {
        $pricechange = $pricechange - (($coreolddata[0]["price"] - $coreupgradepack[0]["price"]) / 30 * $daysleft);
    } else {
        $pricechange = $pricechange + (($coreupgradepack[0]["price"] - $coreolddata[0]["price"]) / 30 * $daysleft);
    }
}

$memoryupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["memory"],
    "upgradeid" => 2,
]);
if(count($memoryupgradepack) != 1){
    $response->setfail(true, "Invalid");
    return;
}

$price = $price + $memoryupgradepack[0]["price"];
$memory = $memoryupgradepack[0]["data"];

if ($memory != $oldvserver->getMemory()) {
    $change = true;
    $memoryolddata = $masterdatabase->select("product_upgrade_values", [
        "price",
        "name",
        "data",
    ], [
        "data" => $oldvserver->getMemory(),
        "upgradeid" => 2,
    ]);
    if ($memory < $oldvserver->getMemory()) {
        $pricechange = $pricechange - (($memoryolddata[0]["price"] - $memoryupgradepack[0]["price"]) / 30 * $daysleft);
    } else {
        $pricechange = $pricechange + (($memoryupgradepack[0]["price"] - $memoryolddata[0]["price"]) / 30 * $daysleft);
    }
}

$diskupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["disk"],
    "upgradeid" => 3,
]);

if(count($diskupgradepack) != 1){
    $response->setfail(true, "Invalid");
    return;
}

$price = $price + $diskupgradepack[0]["price"];
$disk = $diskupgradepack[0]["data"];
$deletedisk = false;
$resizedisk = false;
if ($disk != $oldvserver->getDisk()) {
    $change = true;
    $diskolddata = $masterdatabase->select("product_upgrade_values", [
        "price",
        "name",
        "data",
    ], [
        "data" => $oldvserver->getDisk(),
        "upgradeid" => 3,
    ]);
    if ($disk < $oldvserver->getDisk()) {
        $pricechange = $pricechange - (($diskolddata[0]["price"] - $diskupgradepack[0]["price"]) / 30 * $daysleft);
        $deletedisk = true;
    } else {
        $pricechange = $pricechange + (($diskupgradepack[0]["price"] - $diskolddata[0]["price"]) / 30 * $daysleft);
        $resizedisk = true;
    }
}

if($_POST["slots"] < 2 || $_POST["slots"] > 20 || !is_numeric($_POST["slots"])){
    $response->setfail(true, "Invalid");
    return;
}

$slots = $_POST["slots"] - $oldvserver->getBackupslots();
$costperslot = (0.012 * $disk) + 0.50;
$price = $price + ($costperslot * $_POST["slots"] - 1);
if ($_POST["slots"] != $oldvserver->getBackupslots()) {
    $change = true;
    if ($_POST["slots"] < $oldvserver->getBackupslots()) {
        $pricechange = $pricechange - (($costperslot / 30 * $daysleft * $slots) * -1);
    } else {
        $pricechange = $pricechange + ($costperslot / 30 * $daysleft * $slots);
    }
}

$ipcount = new Ipv4($dependencyInjector, null);
$ipcount = count($ipcount->getAll(["serviceid" => $serviceid]));

$ipupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $ipcount,
    "upgradeid" => 4,
]);

$price = $price + $ipupgradepack[0]["price"];

$pricechange = $pricechange * -1;

$pricechange = $pricechange * (1 - $serviceinfos[0]["discount"]);
$normalprice = $price;
$price = $price * (1 - $serviceinfos[0]["discount"]);
if ($_POST["calculate"] == 1) {
    if($pricechange > 0){
        $pricechange = 0;
    }
    $response->setresponse(["change" => $pricechange, "monthly" => $price]);
    return;
}
if (!$change) {
    $response->setresponse(["message" => "Keine Änderung vorgenommen!"]);
    return;
}
if ($pricechange < 0) {
    $moneyafter = $user->getGuthaben() - ($pricechange * -1);

    if ($moneyafter < 0) {
        $response->setfail(true, "Sie haben für dieses Produkt nicht genügend Guthaben");
        return;
    }
    $user->changeguthaben($masterdatabase, $pricechange, "KVM Server Up/Downgrade");
    logit($masterdatabase, "vserver_main", "id", $oldvserver->getId(), "Up/Downgrade - Kosten: " . $pricechange, $user->getID(), "0.0.0.0");
}

$vserver = new \Ph24\service\VServer($dependencyInjector, $_POST["vserverid"], "childid");

$masterdatabase->insert("vserver_upgrade_log", [
    "vserverid" => $_POST["vserverid"],
    "cores" => $oldvserver->getCores(),
    "memory" => $oldvserver->getMemory(),
    "disk" => $oldvserver->getDisk(),
    "ips" => $ipcount,
    "backups" => $oldvserver->getBackupslots(),
    "money" => $oldprice,
    "cores_after" => $cores,
    "memory_after" => $memory,
    "disk_after" => $disk,
    "ips_after" => $ipcount,
    "backups_after" => $_POST["slots"],
    "money_after" => $price,
]);

$fields = [
    [
        "name" => "Cores",
        "value" => $oldvserver->getCores() . " => " . $cores
    ],
    [
        "name" => "Memory",
        "value" => $oldvserver->getMemory() . " => " . $memory
    ],
    [
        "name" => "Disk",
        "value" => $oldvserver->getDisk() . " => " . $disk
    ],
    [
        "name" => "Ips",
        "value" => $ipcount . " => " . $ipcount
    ],
    [
        "name" => "Backups",
        "value" => $oldvserver->getBackupslots() . " => " . $_POST["slots"]
    ],
    [
        "name" => "Price",
        "value" => ($oldprice * (1 - $serviceinfos[0]["discount"])) . " => " . $price
    ]
];

Functions::sendDataToDiscordFeed("vServer Up/Downgrade",$user->getVorname() . " " . $user->getNachname() . " (" . $user->getID() . ") hat eine Änderung an seinem vServer durchgeführt","https://prohosting24.de/admin/kunden/" . $user->getID(),$fields);


$masterdatabase->update("vserver_main", [
    "cores" => $cores,
    "memory" => $memory,
    "disk" => $disk,
    "backupslots" => $_POST["slots"],
], [
    "id" => $_POST["vserverid"],
]);
if ($deletedisk) {
    $vserver->reinstall();
} else {
    $vserver->reapplyConfig();
}


$masterdatabase->update("service_main", [
    "price" => $normalprice,
], [
    "serviceid" => $_POST["vserverid"],
]);
$response->setresponse(["change" => $pricechange, "monthly" => $price]);

