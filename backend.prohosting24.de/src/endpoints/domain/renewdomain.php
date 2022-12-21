<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);
$domain = new Domain($masterdatabase, $config);
$domaininfo = $masterdatabase->select("service_main", [
    "[>]domain_main" => ["serviceid" => "id"],
    "[>]domain_list" => ["domain_main.tld" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.discount",
    "domain_main.id",
    "domain_list.tld",
    "domain_main.sld",
    "domain_main.kontakt",
    "domain_main.ns1",
    "domain_main.ns2",
    "domain_main.ns3",
    "domain_main.ns4",
    "domain_main.ns5",
], [
    "service_main.serviceid" => $_POST["id"],
    "service_main.produktid" => 4,
]);
$price = $domain->getdomainbytldprice($domaininfo[0]["tld"])[0]["price_renew"];
$price = $price * (1 - $domaininfo[0]["discount"]);
$moneyafter = $user->getGuthaben() - $price;

if ($moneyafter < 0) {
    $response->setfail(true, "Sie haben für dieses Produkt nicht genügend Guthaben");
    return;
}


$user->changeguthaben($masterdatabase, "-" . $price, "Domain Verlängerung");
$masterdatabase->update("service_main", [
    "expire_email" => 0,
    "expire_at" => date('Y-m-d H:i:s', strtotime($domaininfo[0]["expire_at"] . ' + 365 days')),
    "delete_at" => null
], [
    "serviceid" => $_POST["id"],
    "produktid" => 4,
]);
$domain->undodeletedomain($domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"]);
logit($masterdatabase, "domain_main", "id", $_POST["id"], "Die Domain wurde verlängert.", $user->getId(), "-");
sendtodc('Domain Verlängerung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Länge: 365 Tage
Kosten: ' . $price . ' €', $config);
