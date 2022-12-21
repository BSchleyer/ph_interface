<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$users = $masterdatabase->select("main_user", [
    "id",
    "username",
    "vorname",
    "nachname",
    "guthaben",
    "email",
    "status",
    "created_on",
], [
    "id" => $_POST["userid"],
]);

foreach ($users as $userkey => $user) {
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
    $users[$userkey]["moneymade"] = 0;
    $users[$userkey]["moneymadeu"] = 0;
    foreach ($transaktions as $money) {
        $users[$userkey]["moneymade"] = $users[$userkey]["moneymade"] + $money["amount"];
        $users[$userkey]["moneymadeu"] = $users[$userkey]["moneymadeu"] + $money["amount_t"];
    }
    $users[$userkey]["moneymade"] = round($users[$userkey]["moneymade"], 2);
    $users[$userkey]["moneymadeu"] = round($users[$userkey]["moneymadeu"], 2);
    $users[$userkey]["username"] = htmlspecialchars($user["username"]);
    $users[$userkey]["vorname"] = htmlspecialchars($user["vorname"]);
    $users[$userkey]["nachname"] = htmlspecialchars($user["nachname"]);
    $users[$userkey]["email"] = htmlspecialchars($user["email"]);
}
$response->setresponse($users[0]);
