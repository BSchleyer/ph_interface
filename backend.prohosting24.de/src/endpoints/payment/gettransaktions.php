<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (isset($_POST["userid"])) {
    $transaktions = $masterdatabase->select("main_payments", [
        "id",
        "amount",
        "amount_t",
        "created_on",
    ], [
        "status" => 1,
        "ORDER" => ["id" => "DESC"],
        "userid" => $_POST["userid"],
    ]);
    $response->setresponse($transaktions);
    return;
}

$transaktions = $masterdatabase->select("main_payments", [
    "[>]main_user" => ["userid" => "id"],
], [
    "main_payments.id",
    "main_user.username",
    "main_payments.amount",
    "main_payments.amount_t",
    "main_payments.created_on",
], [
    "main_payments.status" => 1,
    "ORDER" => ["main_payments.id" => "DESC"],
    "LIMIT" => 400,
]);


$currentday = date('Y-m-d 0:0:0', time());
$day = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $currentday,
]);


$firstdayofweek = date('Y-m-d 0:0:0', strtotime('-' . date('w') . ' days'));
$week = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $firstdayofweek,
]);


$firstdayofmonth = date('Y-m-1 0:0:0', time());
$month = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $firstdayofmonth,
]);

$month_ini = new DateTime("first day of last month");
$month_end = new DateTime("last day of last month");
$firstdayofmonthlast = $month_ini->format('Y-m-d 0:0:0');
$lastdayofmonthlast = $month_end->format('Y-m-d 0:0:0');
$monthlast = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $firstdayofmonthlast,
    "created_on[<]" => $lastdayofmonthlast,
]);


$firstdayofyear = date('Y-1-1 0:0:0', time());
$year = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $firstdayofyear,
]);


$all = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
]);


$day30daysago = date('Y-m-d 00:00:00', strtotime('-30 days'));
$graphdata = $masterdatabase->query("SELECT sum(amount_t), date_trunc('day', created_on) as day FROM main_payments where created_on > '" . $day30daysago . "' and \"status\" = 1 group by day;")->fetchAll();
$graphtmp = [];
foreach ($graphdata as $data) {
    $graphtmp[$data["day"]] = $data;
}

$graphoutput = [];

for ($i = 30; $i > -1; $i--) {
    $date = date('Y-m-d 00:00:00', strtotime('-' . $i . ' days'));
    if (isset($graphtmp[$date])) {
        array_push($graphoutput, [strtotime($date), (float) $graphtmp[$date]["sum"]]);
    } else {
        array_push($graphoutput, [strtotime($date), 0]);
    }
}
if ($day == null) {
    $day = 0;
}

if ($week == null) {
    $week = 0;
}
if ($month == null) {
    $month = 0;
}

$creditcount = $masterdatabase->select("main_credit_count", [
    "count",
    "created_on",
]);
$creditout = [];
foreach ($creditcount as $credit) {
    $creditout[strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"])))] = [strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"]))), $credit["count"]];
}

$creditoutr = [];

for ($i = 30; $i > -1; $i--) {
    $date = strtotime(date('Y-m-d 00:00:00', strtotime('-' . $i . ' days')));
    if (isset($creditout[$date])) {
        array_push($creditoutr, [$date, $creditout[$date][1]]);
    } else {
        array_push($creditoutr, [$date, 0]);
    }
}


$creditcount = $masterdatabase->select("stats_transactions", [
    "count",
    "created_on",
]);
$creditout = [];
foreach ($creditcount as $credit) {
    $creditout[strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"])))] = [strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"]))), $credit["count"]];
}

$stats_transactions = [];

for ($i = 30; $i > -1; $i--) {
    $date = strtotime(date('Y-m-d 00:00:00', strtotime('-' . $i . ' days')));
    if (isset($creditout[$date])) {
        array_push($stats_transactions, [$date, $creditout[$date][1]]);
    } else {
        array_push($stats_transactions, [$date, 0]);
    }
}

$creditcount = $masterdatabase->select("stats_estimated_sales", [
    "count",
    "created_on",
]);
$creditout = [];
foreach ($creditcount as $credit) {
    $creditout[strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"])))] = [strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"]))), $credit["count"]];
}

$stats_estimated_sales = [];

for ($i = 30; $i > -1; $i--) {
    $date = strtotime(date('Y-m-d 00:00:00', strtotime('-' . $i . ' days')));
    if (isset($creditout[$date])) {
        array_push($stats_estimated_sales, [$date, $creditout[$date][1]]);
    } else {
        array_push($stats_estimated_sales, [$date, 0]);
    }
}

$creditcount = $masterdatabase->select("stats_remaining_sales", [
    "count",
    "created_on",
]);
$creditout = [];
foreach ($creditcount as $credit) {
    $creditout[strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"])))] = [strtotime(date('Y-m-d 00:00:00', strtotime($credit["created_on"]))), $credit["count"]];
}

$stats_remaining_sales = [];

for ($i = 30; $i > -1; $i--) {
    $date = strtotime(date('Y-m-d 00:00:00', strtotime('-' . $i . ' days')));
    if (isset($creditout[$date])) {
        array_push($stats_remaining_sales, [$date, $creditout[$date][1]]);
    } else {
        array_push($stats_remaining_sales, [$date, 0]);
    }
}

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
    $date = strtotime(date('Y-m',strtotime($trans["created_on"])));
    if(!isset($data[$date])){
        $data[$date] = 0;
    }
    $data[$date] = $data[$date] + $trans["amount_t"];
}
ksort($data);
$edata = [];
foreach ($data as $key => $in) {
    $edata[] = [$key, $in];
}

$transactions = $masterdatabase->select("stats_invoice","*", [
    "ORDER" => ["id" => "DESC"]
]);

$data = [];

foreach ($transactions as $trans) {
    $date = strtotime(date('Y-m',strtotime($trans["created_on"])));
    $data[$date] = $trans["count"];
}
ksort($data);
$stats_invoice = [];
foreach ($data as $key => $in) {
    $stats_invoice[] = [$key, $in];
}


$stats_day_avg = [];


foreach ($edata as $entry){
    $daysInMonth = new DateTime();

    $daysInMonth->setTimestamp($entry[0]);
    $stats_day_avg[] = [
        $entry[0],
        $entry[1] / cal_days_in_month(CAL_GREGORIAN, $daysInMonth->format('m'), $daysInMonth->format('Y'))
    ];
}

$response->setresponse([
    "data" => $edata,
    "transaktions" => $transaktions,
    "day" => round($day, 2),
    "week" => round($week, 2),
    "month" => round($month, 2),
    "lastmonth" => round($monthlast, 2),
    "year" => round($year, 2),
    "all" => round($all, 2),
    "graph" => $graphoutput,
    "credit" => $creditoutr,
    "stats_estimated_sales" => $stats_estimated_sales,
    "stats_remaining_sales" => $stats_remaining_sales,
    "stats_transactions" => $stats_transactions,
    "stats_invoice" => $stats_invoice,
    "stats_day_avg" => $stats_day_avg
]);
