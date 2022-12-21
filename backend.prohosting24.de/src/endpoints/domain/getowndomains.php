<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
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
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 4,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $domain) {
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
    $services[$key]["delete_at"] = strtotime($domain["delete_at"]);
    $services[$key]["timeleft"] = strtotime($domain["expire_at"]);
}

$response->setresponse($services);
