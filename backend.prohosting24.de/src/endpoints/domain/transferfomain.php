<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["userid", "domain", "ns1", "ns2", "ns3", "ns4", "ns5", "kontaktid", "authcode"])) {
    $response->setfail(true, "Alle Felder müssen ausgefüllt sein");
    return;
}

$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);
$domain = new Domain($masterdatabase, $config);
$price = $domain->getdomainbytldprice(explode(".", $_POST["domain"])[1])[0]["price_renew"];

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
$domain->adddomain($_POST["domain"], $_POST["kontaktid"], $nsidarray, $user->getID(),$_POST["authcode"]);


$masterdatabase->insert("service_main", [
    "userid" => $user->getId(),
    "produktid" => 4,
    "serviceid" => $domain->getdomainbydomain($_POST["domain"])["id"],
    "price" => $price,
    "upgradeble" => 0,
    "expire_at" => date('Y-m-d H:i:s', strtotime('+365 days')),
]);
