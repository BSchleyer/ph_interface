<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$users = $masterdatabase->select("main_user", [
    "id",
    "username",
    "vorname",
    "nachname",
    "guthaben",
    "email",
    "status",
    "created_on",
]);

foreach ($users as $userkey => $user) {
    $users[$userkey]["username"] = htmlspecialchars($user["username"]);
    $users[$userkey]["vorname"] = htmlspecialchars($user["vorname"]);
    $users[$userkey]["nachname"] = htmlspecialchars($user["nachname"]);
    $users[$userkey]["email"] = htmlspecialchars($user["email"]);
}

$response->setresponse($users);
