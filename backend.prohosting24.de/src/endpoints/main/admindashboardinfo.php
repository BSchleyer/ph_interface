<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$currentday = date('Y-m-d 0:0:0', time());
$day = $masterdatabase->sum("main_payments", [
    "amount_t",
], [
    "status" => 1,
    "created_on[>]" => $currentday,
]);
if ($day == null) {
    $day = 0;
}

$usercount = $masterdatabase->count("main_user", []);

$mailcount = $masterdatabase->count("mail_queue", [
    "done" => 0,
]);


$freeips =  new Ipv4($dependencyInjector, null);
$freeips = count($freeips->getAll(["serviceid" => null]));

$ratelimitcount = $masterdatabase->count("main_ratelimit", []);
$currenttime = date('Y-m-d H:i:s', time());
$currenttimee = date("Y-m-t", strtotime($currenttime));
$services = $masterdatabase->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "vserver_main.id",
    "vserver_main.cores",
    "vserver_main.memory",
    "vserver_main.disk",
], [
    "delete_done[=]" => 0,
    "expire_at[>]" => $currenttime,
    "ORDER" => ["service_main.id" => "ASC"],
]);

$corecount = 0;
$memory = 0;
$disk = 0;

foreach ($services as $service) {
    $corecount += $service["cores"];
    $memory += $service["memory"];
    $disk += $service["disk"];
}
$monthlymoney = $masterdatabase->select("service_main", [
    "price",
    "userid",
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


$userList = $masterdatabase->select('main_user', [
    'id',
    'guthaben'
]);

$formatedUserList = [];

foreach ($userList as $user){
    $formatedUserList[$user["id"]] = $user["guthaben"];
}

$etaRemaningSalesNoMoney = 0;

foreach ($monthlymoney as $money) {
    $moneyy += $money["price"] * (1 - $money["discount"]);
    if($formatedUserList[$money["userid"]] < ($money["price"] * (1 - $money["discount"]))){
        $etaRemaningSalesNoMoney += $money["price"] * (1 - $money["discount"]);
    }
}
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

$hourlymoney = $masterdatabase->select("service_main", [
    "price",
    "discount",
], [
    "delete_done[=]" => 0,
    "hide" => 0,
    "hourly" => 1,
    "produktid" => [1, 2, 3, 5],
]);
$hourlyMoneyCount = 0;

foreach ($hourlymoney as $money) {
    $hourlyMoneyCount += $money["price"] * (1 - $money["discount"]);
}

$hourlymoneyNotPaid  = $masterdatabase->select("hourly_log", [
    "price",
], [
    "paid[=]" => 0,
]);

$hourlymoneyNotPaidSum = 0;

foreach ($hourlymoneyNotPaid as $money) {
    $hourlymoneyNotPaidSum += $money["price"];
}

$invoiceNotPaid  = $masterdatabase->select("main_log_credit", [
    "change",
], [
    "paid[=]" => 0,
]);

$invoiceNotPaidSum = 0;

foreach ($invoiceNotPaid as $money) {
    $invoiceNotPaidSum += $money["change"];
}

$invoiceNotPaidSum = round($invoiceNotPaidSum * -1, 2);



$response->setresponse([
    "monthly" => round($moneyyy),
    "monthlyt" => round($moneyy),
    "etaRemaningSalesNoMoney" => round($etaRemaningSalesNoMoney),
    "money" => round($day),
    "hourly" => round($hourlyMoneyCount, 4),
    "usercount" => $usercount,
    "mailcount" => $mailcount,
    "ratelimit" => $ratelimitcount,
    "freeips" => $freeips,
    "cores" => $corecount,
    "memory" => $memory,
    "disk" => $disk,
    "invoiceNotPaid" => $invoiceNotPaidSum,
    "hourlyServerCount" => count($hourlymoney),
    "hourlyNotPaid" => round($hourlymoneyNotPaidSum, 2),
]);


