<?php



$domainMaster = new Domain($masterdatabase,$config);

$domainList = $domainMaster->gatalldomainsfromapi()["data"]["domains"];

$domainDB = $masterdatabase->select("service_main", [
    "[>]domain_main" => ["serviceid" => "id"],
    "[>]domain_list" => ["domain_main.tld" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.discount",
    "service_main.id",
    "domain_list.tld",
    "domain_main.sld",
    "domain_main.kontakt",
    "domain_main.ns1",
    "domain_main.ns2",
    "domain_main.ns3",
    "domain_main.ns4",
    "domain_main.ns5",
], [
    "service_main.produktid" => 4,
    "service_main.delete_at" => null,
]);

$formatedDB = [];

foreach ($domainDB as $domain){
    $formatedDB[$domain["sld"] . "." . $domain["tld"]] = $domain;
}

foreach ($domainList as $domain){
    if(isset($formatedDB[$domain["name"]])){
        $dbDate = new DateTime($formatedDB[$domain["name"]]["expire_at"]);
        $apiDate = new DateTime($domain["expire"]);
        date_sub($apiDate, date_interval_create_from_date_string('72 hours'));
        if($dbDate->format(\DateTime::ISO8601) != $apiDate->format(\DateTime::ISO8601)){
            if($domain["expire"] == null){
                continue;
            }
            
            $masterdatabase->update("service_main", [
                "expire_at" => $dbDate->format('Y') . $apiDate->format('-m-d H:i:s'),
            ], [
                "id[=]" => $formatedDB[$domain["name"]]["id"],
            ]);
        }
    }
}