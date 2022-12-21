<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "ns1", "ns2", "ns3", "ns4", "ns5"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$domain = new Domain($masterdatabase, $config);
$nsarray = [];
for ($i = 1; $i < 6; $i++) {
    if ($_POST["ns" . $i] != "") {
        $nsinfo = $domain->addnameserver($_POST["ns" . $i]);
        if (!is_int($nsinfo)) {
            $response->setfail(true, $nsinfo);
            return;
        }
        array_push($nsarray, $nsinfo);
    } else {
        array_push($nsarray, -1);
    }
}

$domaininfo = $masterdatabase->select("service_main", [
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
]);
if ($_POST["ns1"] == "ns1.prohosting24.de") {
    $ns = new Nameserver($dependencyInjector);
    $ns->adddomain($domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"] . ".");
    sleep(1);
}

$res = $domain->editdomain($_POST["id"], $domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"], $domaininfo[0]["kontakt"], $nsarray);
$response->setresponse($res);
