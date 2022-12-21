<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$domain = new Domain($masterdatabase, $config);
$domains = $domain->gatalldomainsfromapi();

$domainss = [];

foreach ($domains["data"]["domains"] as $domain) {
    $domainss[$domain["sld"] . "." . $domain["tld"]] = 1;
}
$currenttime = date('Y-m-d H:i:s', time());

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
], [
    "service_main.expire_at[>]" => $currenttime,
    "service_main.delete_at" => null,
    "service_main.produktid" => 4,
]);
$servicess = [];

foreach ($services as $service) {
    if (isset($domainss[$service["sld"] . "." . $service["tld"]])) {
        $domainss[$service["sld"] . "." . $service["tld"]] = 0;
    }
}







$domainsout = [];

foreach ($domainss as $domainkey => $domain) {
    if ($domain == 1) {
        $domainsout[] = $domainkey;
    }
}
$response->setresponse($domainsout);
