<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid", "disk", "domain", "days"])) {
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
if ($_POST["days"] < 1) {
    $response->setfail(true, "Bitte eine Positive Zahl eingeben.");
    return;
}
if (strpos($_POST["days"], '.') !== false) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}


$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);
$price = 0;

$diskupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $_POST["disk"],
    "upgradeid" => 5,
]);
if (count($diskupgradepack) != 1) {
    $response->setfail(true, "Dieser Wert existiert nicht.");
    return;
}

$price += $diskupgradepack[0]["price"];
$disk = $diskupgradepack[0]["data"];


$produktinfos = $masterdatabase->select("product_main", [
    "typid",
    "name",
    "price",
], [
    "id" => 2,
]);


$price += $produktinfos[0]["price"];
$normalprice = $price;
$price = $price * ($_POST["days"] / 30);
$discount = 0;
$discountedprice = $price;
if (isset($_POST["discountcode"])) {
    if ($_POST["discountcode"] != "") {
        $discounto = new Discount($dependencyInjector, $_POST["discountcode"], "code");
        $discounto->checkDiscount(2);
        $discountedprice = $discounto->getPrice($price);
        $discount = $discounto->getData()["amount"];
        $discounto->redeem();
        if ($discounto->getValue('type') == 2) {
            $discount = 0;
        }
    }
}



$webspace = new Webspace($masterdatabase, $config);

foreach ($webspace->getallwespaces() as $webspaceDetail){
    if($webspaceDetail->name == $_POST["domain"]){
        $response->setfail(true, $dependencyInjector->getLang()->getString("domainalreadyinuse"));
        return;
    }
}

if(!$user->pay("Webspace Kauf", $discountedprice, $dependencyInjector)){
    $response->setfail(true, $dependencyInjector->getLang()->getString("notenoughcredit"));
    return;
}
$paymentId = $masterdatabase->id();

$packageinfo = $webspace->getpackagespeicher($disk);

$webspaceid = $webspace->addwebspace($user->getID(), $packageinfo[0]["id"], $_POST["domain"]);


$masterdatabase->insert("service_main", [
    "userid" => $user->getId(),
    "produktid" => 2,
    "serviceid" => $webspaceid,
    "price" => $price / ($_POST["days"] / 30),
    "upgradeble" => 1,
    "discount" => $discount,
    "expire_at" => date('Y-m-d H:i:s', strtotime('+' . $_POST["days"] . ' days')),
]);
$creditLog = new CreditLog($dependencyInjector, $paymentId);
$creditLog->setValue("serviceid", $masterdatabase->id());
$creditLog->update();
logit($masterdatabase, "webspace_main", "id", $webspaceid, "Ihr WebHosting wurde angelegt", $user->getID(), "-");
$mail = new Mail($masterdatabase, $config);
$mail->addmail("webspace_order", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "count_gb" => $disk]);

sendtodc('Neue Webspace Bestellung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Disk: ' . $_POST["disk"] . ' GB
Kosten: ' . $price . ' €', $config);
