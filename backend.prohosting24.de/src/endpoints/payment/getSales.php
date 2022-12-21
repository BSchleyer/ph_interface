<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


$transactions = $masterdatabase->select("main_payments",[
    "id",
    "amount",
    "amount_t",
    "created_on",
], [
    "status" => 1,
    "ORDER" => ["id" => "DESC"]
]);


$data = [];

foreach ($transactions as $trans) {
    $date = strtotime(date('Y-m',strtotime($trans["created_on"]))) * 1000;
    if(!isset($data[$date])){
        $data[$date] = 0;
    }
    $data[$date] = $data[$date] + $trans["amount_t"];
}
$response->setresponse($data);
