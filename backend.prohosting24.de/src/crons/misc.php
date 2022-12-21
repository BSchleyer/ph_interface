<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$credit = $masterdatabase->sum("main_user", "guthaben");
$masterdatabase->insert("main_credit_count", [
    "count" => $credit,
]);
$currenttime = date('Y-m-d H:i:s', time());

$currenttimee = date("Y-m-d H:i:s", strtotime("+30 days",time()));
$monthlymoney = $masterdatabase->select("service_main", [
    "price",
    "discount",
], [
    "expire_at[>]" => $currenttime,
    "expire_at[<]" => $currenttimee,
    "delete_done[=]" => 0,
    "hide" => 0,
    "hourly" => 0,
    "produktid" => [1, 2, 3, 5],
]);
$moneyy = 0;

foreach ($monthlymoney as $money) {
    $moneyy += $money["price"] * (1 - $money["discount"]);
}

$masterdatabase->insert("stats_remaining_sales", [
    "count" => $moneyy,
]);

$monthlymoney = $masterdatabase->select("service_main", [
    "price",
    "discount",
], [
    "expire_at[>]" => $currenttime,
    "delete_done[=]" => 0,
    "hide" => 0,
    "hourly" => 0,
    "produktid" => [1, 2, 3, 5],
]);
$moneyyy = 0;

foreach ($monthlymoney as $money) {
    $moneyyy += $money["price"] * (1 - $money["discount"]);
}


$masterdatabase->insert("stats_estimated_sales", [
    "count" => $moneyyy,
]);
$currenttime = date('Y-m-d', strtotime("-1 day",time()));
$monthlymoney = $masterdatabase->select("main_log_credit", "*", [
    "created_on[>]" => $currenttime
]);

$masterdatabase->insert("stats_transactions", [
    "count" => count($monthlymoney),
]);
