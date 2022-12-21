<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
$currenttime = date('Y-m-d H:i:s', time());


$result = $masterdatabase->select("main_credit_add", "*", [
    "active" => 1,
    "expire_at[>]" => $currenttime,
]);
if (count($result) != 1) {
    $response->setresponse(0);
    return;
}
$response->setresponse([$result[0]["percent"], $result[0]["message"]]);
