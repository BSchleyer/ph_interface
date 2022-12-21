<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$redisKey = sha1("dashboard_" . $_POST["userid"]);

$value = $client->get($redisKey);

if(isset($value)){
    $response->setresponse(json_decode($value,true),true);
    return;
}


$respondData = [];
$ticket = new Ticket();
$tickets = $ticket->gettickets($masterdatabase, 2, $_POST["userid"], 0);
foreach ($tickets as $ticketid => $ticket) {
    $tickets[$ticketid]["title"] = htmlspecialchars($tickets[$ticketid]["title"]);
    $tickets[$ticketid]["last_answer"] = niceDate($tickets[$ticketid]["last_answer"]);
    $tickets[$ticketid]["created_on"] = niceDate($tickets[$ticketid]["created_on"]);
}
$respondData["supportData"] = $tickets;
$mail = new Mail($masterdatabase, $config);

$maillist = $mail->getemailsbyuserid($_POST["userid"],4);

$return = [];

foreach ($maillist as $key => $entry) {
    $return[$key] = $entry;
    $return[$key]["title"] = $mail->convertEmailContent($return[$key]["title"],[], $dependencyInjector);
    $return[$key]["created_on"] = niceDate($entry["created_on"]);
}
$respondData["emailData"] = $return;
$currenttime = date('Y-m-d H:i:s', time());

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
$respondData["serviceData"] = $servicelist;

$userNew = new UserNew($dependencyInjector, $_POST["userid"]);
if(!is_int($userNew->getValue("sevdeskid"))){
    $respondData["invoiceData"] = [];
} else {
    $sevdeskApiClient = new SevDeskApiClient($dependencyInjector);

    $invoiceList = $sevdeskApiClient->getInvoiceList($userNew);

    $respondData["invoiceData"] = [];

    foreach ($invoiceList["objects"] as $invoice){
        if($invoice["status"] == "100" || $invoice["status"] == "200"){
            $respondData["invoiceData"][] = [
                "id" => $invoice["id"],
                "date" => niceDate($invoice["create"]),
                "name" => $invoice["header"],
                "number" => $invoice["invoiceNumber"],
                "total" => niceNumber($invoice["sumGross"]),
                "left" => niceNumber($invoice["sumGross"] - $invoice["paidAmount"]),
                "status" => $invoice["status"],
            ];
        }
    }

}
$respondData["cachedSha1"] = $redisKey;

$client->set($redisKey, json_encode($respondData));
$client->expire($redisKey, 60);

$response->setresponse($respondData);
