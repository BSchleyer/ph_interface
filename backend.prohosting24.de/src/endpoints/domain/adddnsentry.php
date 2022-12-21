<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "subdomain", "type", "content", "ttl", "prio"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
if ($_POST["type"] == 'TS') {
    $_POST["type"] = 'SRV';
}

if ($_POST["type"] == 'MC') {
    $_POST["type"] = 'SRV';
}

$services = $masterdatabase->select("service_main", [
    "[>]domain_main" => ["serviceid" => "id"],
    "[>]domain_list" => ["domain_main.tld" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
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
])[0];

if ($_POST["ttl"] != 120) {
    $_POST["ttl"] = 120;
}





$domain = new DomainNew($dependencyInjector, $_POST["id"]);


$nameserver = new Nameserver($dependencyInjector);

$nameserver->addRecord($domain->getDomainName(),$_POST["type"],urldecode($_POST["content"]),$_POST["ttl"],$_POST["subdomain"]);
