<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["serviceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$services = $masterdatabase->select("service_main", [
    "[>]domain_main" => ["serviceid" => "id"],
    "[>]domain_list" => ["domain_main.tld" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.id(serviceidnew)",
    "service_main.discount",
    "service_main.status",
    "service_main.price",
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
    "service_main.serviceid" => $_POST["serviceid"],
    "service_main.produktid" => 4,
]);

if ($services[0]["status"] == 1) {
    $response->setfail(true, "Dieser Service ist gesperrt.");
    return;
}
$domaino = new Domain($masterdatabase, $config);
foreach ($services as $key => $domain) {
    $access = new AccessUser($dependencyInjector, null);
    $access = $access->getAll(["serviceid" => $domain["serviceidnew"], "status" => 1]);
    $accessList = [];

    foreach ($access as $accessEntry){
        $accessList[] = $accessEntry->getValue("userid");
    }
    $services[$key]["accessUsers"] = $accessList;
    $services[$key]["price"] = $domain["price"] * (1 - $domain["discount"]);
    if ((strtotime($domain["expire_at"]) - time()) < 0) {
        if ($domain["delete_at"] != null) {
            if ((strtotime($domain["delete_at"]) - time()) < 0) {
                $services[$key]["status"] = "deleted";
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $services[$key]["status"] = "expired";
        }
    } else {
        $services[$key]["status"] = "running";
    }
    $services[$key]['price'] = $domaino->getdomainbytldprice($services[$key]['tld'])[0]["price_renew"];
    for ($i = 1; $i < 6; $i++) {
        if ($services[$key]['ns' . $i] != null) {
            $services[$key]['ns' . $i] = $domaino->getnameserverbyid($services[$key]['ns' . $i])[0]["servername"];
        }
    }
    $services[$key]["delete_at"] = strtotime($domain["delete_at"]);
    $services[$key]["timeleftdelete"] = strtotime($domain["delete_at"]);
    $services[$key]["timeleft"] = strtotime($domain["expire_at"]);
    $nameserver = new Nameserver($dependencyInjector);
    $dnsarray = $nameserver->getRecords($services[$key]['sld'].".".$domain['tld']);
    $services[$key]['dns'] = [];
    foreach ($dnsarray as $dnskey => $dnsvalue) {
        if (($dnsvalue["type"] != "SOA") && ($dnsvalue["type"] != "NS")) {
            $services[$key]['dns'][] = $dnsvalue;
        }
    }
}

$response->setresponse($services[0]);
