<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid", "domain", "ns1", "ns2", "ns3", "ns4", "ns5", "kontaktid", "authCode"])) {
    $response->setfail(true, "Alle Felder müssen ausgefüllt sein");
    return;
}

if($_POST["authCode"] != "0"){
    $transfer = true;
} else {
    $transfer = false;
}

$_POST["domain"] = strtolower($_POST["domain"]);

$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);
$domain = new Domain($masterdatabase, $config);
$domainPrice = $domain->getdomainbytldprice(explode(".", $_POST["domain"])[1]);
if($transfer){
    $price = $domainPrice[0]["price_transfer"];
} else {
    $price = $domainPrice[0]["price_create"];
}
if($domainPrice[0]["price_ownerchange"] != 0 || $domainPrice[0]["price_update"] != 0){
    $response->setfail(true, "Diese Domain ist nicht verfügbar.");
    return;
}

$ns = new Nameserver($dependencyInjector);
$nsidarray = [];
for ($i = 1; $i < 6; $i++) {
    if ($_POST["ns" . $i] != "0") {
        $nsinfo = $domain->addnameserver($_POST["ns" . $i]);
        if (!is_int($nsinfo)) {
            $response->setfail(true, $nsinfo);
            return;
        }
        array_push($nsidarray, $nsinfo);
    }
}

if(!$user->pay("Domain Kauf", $price, $dependencyInjector, false)){
    $response->setfail(true, $dependencyInjector->getLang()->getString("notenoughcredit"));
    return;
}

$ns->adddomain($_POST["domain"]);
$ns->checkDomain($_POST["domain"]);

if($transfer){
    $result = $domain->adddomain($_POST["domain"], $_POST["kontaktid"], $nsidarray, $user->getID(), $_POST["authCode"]);
} else {
    $result = $domain->adddomain($_POST["domain"], $_POST["kontaktid"], $nsidarray, $user->getID());
}
if($result != ""){
    $response->setfail(true, $dependencyInjector->getLang()->getString("domainordererror"));
    return;
}

$user->pay("Domain Kauf", $price, $dependencyInjector);
$paymentId = $masterdatabase->id();

$price = $domain->getdomainbytldprice(explode(".", $_POST["domain"])[1])[0]["price_renew"];



$masterdatabase->insert("service_main", [
    "userid" => $user->getId(),
    "produktid" => 4,
    "serviceid" => $domain->getdomainbydomain($_POST["domain"])["id"],
    "price" => $price,
    "upgradeble" => 0,
    "expire_at" => date('Y-m-d H:i:s', strtotime('+365 days')),
]);

$mail = new Mail($masterdatabase, $config);
$mail->addmail("domain_order", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "domainname" => $_POST["domain"]]);

$creditLog = new CreditLog($dependencyInjector, $paymentId);
$creditLog->setValue("serviceid", $masterdatabase->id());
$creditLog->update();

logit($masterdatabase, "domain_main", "id", $masterdatabase->id(), "Die Domain wurde erstellt.", $user->getId(), "-");
sendtodc('Neue Domain Bestellung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Domain: ' . $_POST["domain"] . '
Kosten: ' . $price . ' €', $config);