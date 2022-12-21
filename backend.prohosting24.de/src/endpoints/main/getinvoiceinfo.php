<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$invoiceInfo = new InvoiceInfo($dependencyInjector,null);

$invoiceInfo = $invoiceInfo->getAll(["userid" => $_POST["userid"]]);

if(count($invoiceInfo) == 1){
    $invoiceInfo = $invoiceInfo[0];
    $return = [
        "company_name" => $invoiceInfo->getValue("company_name"),
        "street" => $invoiceInfo->getValue("street"),
        "house_number" => $invoiceInfo->getValue("house_number"),
        "plz" => $invoiceInfo->getValue("plz"),
        "city" => $invoiceInfo->getValue("city"),
        "country" => $invoiceInfo->getValue("country"),
    ];
} else {
    $return = [];
}

$countrys = new SevdeskCountrys($dependencyInjector, null);
$countrys = $countrys->getAll([],true);

$response->setresponse(["data" => $return, "countrys" => $countrys]);
