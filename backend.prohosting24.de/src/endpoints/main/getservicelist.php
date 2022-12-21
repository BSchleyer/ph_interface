<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$currenttime = date('Y-m-d H:i:s', time());
if(isset($_POST["all"])){
    if(isset($_POST["hourly"])) {
        $servicelist = $masterdatabase->select("service_main", [
            "id",
            "serviceid",
            "produktid",
            "price",
            "status",
            "discount",
            "expire_at",
            "delete_done",
            "expire_email",
            "name(name_p)"
        ], [
            "hourly" => $_POST["hourly"],
            "userid" => $_POST["userid"],
        ]);
    } else {
        $servicelist = $masterdatabase->select("service_main", [
            "id",
            "serviceid",
            "produktid",
            "price",
            "status",
            "discount",
            "expire_at",
            "delete_done",
            "expire_email",
            "name(name_p)"
        ], [
            "userid" => $_POST["userid"],
        ]);
    }
} else {
    $servicelist = $masterdatabase->select("service_main", [
        "id",
        "serviceid",
        "produktid",
        "price",
        "status",
        "discount",
        "expire_at",
    ], [
        "userid" => $_POST["userid"],
        "expire_at[>]" => $currenttime,
        "delete_done[=]" => 0,
        "hide" => 0,
    ]);
}

$productList = New Product($dependencyInjector, null);
$productList = $productList->getAll([], true);

$sortedProductList = [];

foreach ($productList as $product){
    $sortedProductList[$product["id"]] = $product;
}

$applist = new PteroProducts($dependencyInjector, null);
$applist = $applist->getAll([],true);

$formatedAppList = [];

foreach ($applist as $app){
    $formatedAppList[$app["id"]] = $app;
}

$domainList = new DomainList($dependencyInjector, null);
$domainList = $domainList->getAll([], true);

$domainListFormated = [];

foreach ($domainList as $domain){
    $domainListFormated[$domain["id"]] = $domain;
}


foreach ($servicelist as $servicekey => $service) {
    $servicelist[$servicekey]["timeleft"] = strtotime($service["expire_at"]);
    $servicelist[$servicekey]["expire_at"] = niceDate($service["expire_at"]);
    $servicelist[$servicekey]["name"] = $sortedProductList[$service["produktid"]]["name"];
    switch ($service["produktid"]){
        case 2:
            if(strtotime($service["expire_at"]) > time()){
                $webspace = new WebspaceNew($dependencyInjector, $service["serviceid"]);
                if($servicelist[$servicekey]["name_p"] == ""){
                    $servicelist[$servicekey]["name_p"] = $webspace->getValue("domain");
                } else {
                    $servicelist[$servicekey]["name_p"] = $webspace->getValue("domain") . " - " . $service["name_p"];
                }
            }
            break;
        case 5:
            if(strtotime($service["expire_at"]) > time()){
                $pteroService = new PteroService($dependencyInjector, $service["serviceid"]);
                if($servicelist[$servicekey]["name_p"] == ""){
                    $servicelist[$servicekey]["name_p"] = $formatedAppList[$pteroService->getValue("productid")]["displayname"];
                } else {
                    $servicelist[$servicekey]["name_p"] = $formatedAppList[$pteroService->getValue("productid")]["displayname"] . " - " . $service["name_p"];
                }
            }
            break;
        case 4:
            if(strtotime($service["expire_at"]) > time()){
                $domain = new DomainNew($dependencyInjector, $service["serviceid"]);
                $servicelist[$servicekey]["name_p"] = $domain->getValue("sld"). "." . $domainListFormated[$domain->getValue("tld")]["tld"];
            }
            break;
    }
}

$response->setresponse($servicelist);
