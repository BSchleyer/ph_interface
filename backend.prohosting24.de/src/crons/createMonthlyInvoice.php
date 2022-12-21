<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


$creditLog = $masterdatabase->select("main_log_credit","*",["paid" => 0]);

$creditList = [];

foreach ($creditLog as $entry){
    if(!isset($creditList[$entry["userid"]])){
        $creditList[$entry["userid"]] = [];
    }

    $price = floatval(str_replace("+", "", str_replace("-", "", $entry["change"])));

    $creditList[$entry["userid"]][] = [
        "price" => $price,
        "name" => $entry["reason"]
    ];
}

$payment = new Payment($config,  $dependencyInjector);
$totalPriceAllInvoices = 0;
foreach ($creditList as $userid => $entry){
    $user = new User();
    $user->load_id($masterdatabase, $userid);

    $lang = new LanguageMaster($dependencyInjector, $user->getLang());
    $dependencyInjector->setLang($lang);

    $total = 0;
    foreach ($entry as $data){
        $total += $data["price"];
    }
    $totalPriceAllInvoices += $total;

    $payment->createInvoice($user,$total, $entry,false, 14);
    $masterdatabase->update("main_log_credit",[
        "paid" => 1
    ],[
        "userid" => $userid
    ]);
}
$masterdatabase->insert("stats_invoice", [
    "count" => $totalPriceAllInvoices,
]);