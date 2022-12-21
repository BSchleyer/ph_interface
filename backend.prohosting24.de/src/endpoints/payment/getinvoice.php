<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$transactions = $masterdatabase->select("main_log_credit", "*", [
    "id" => $_POST["id"],
]);
if (count($transactions) != 1) {
    $response->setfail(true, "Diese Transaktion extistiert nicht.");
    return;
}

$response->setresponse($transactions[0]);
