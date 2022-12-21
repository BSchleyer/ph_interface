<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["serviceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$service = $masterdatabase->select("service_main", [
    "userid",
    "price",
    "discount",
    "expire_at",
    "delete_at",
], [
    "id" => $_POST["serviceid"],
]);
if (count($service) != 1) {
    $response->setfail(true, "Error");
    return;
}
$expire = strtotime($service[0]["expire_at"]);
$now = time();
$daysleft = floor(($expire - $now) / (24 * 60 * 60));
$price = round((($service[0]["price"] * (1 - $service[0]["discount"])) / 30) * $daysleft, 2);
$user = new User();
$user->load_id($masterdatabase, $service[0]["userid"]);
$user->changeguthaben($masterdatabase, $price, "Service Storno - ServiceID: " . $_POST["serviceid"]);
$masterdatabase->update("service_main", [
    "expire_at" => date('Y-m-d H:i:s', $now),
], [
    "id" => $_POST["serviceid"],
]);
