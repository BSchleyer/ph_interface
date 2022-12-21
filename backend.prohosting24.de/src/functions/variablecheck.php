<?php


function checkusername($username, $masterdatabase)
{
    if (strlen($username) < 5) {
        return "Der Nutzername ist zu kurz.";
    }
    if (preg_match("/[^a-zA-Z0-9]+/", $username)) {
        return "Der Nutzername darf keine besonderen Zeichen enthalten.";
    }
    $user = $masterdatabase->select("main_user", [
        "status",
    ], [
        "username[=]" => $username,
    ]);
    if (count($user) > 0) {
        if ($user[0]["status"] == 3) {
            return "";
        } else {
            return "Dieser Nutzername ist bereits vergeben.";
        }
    }
    return "";
}

function checkemail($email, $masterdatabase)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Keine Valide Email.";
    }
    $user = $masterdatabase->select("main_user", [
        "status",
    ], [
        "email[=]" => $email,
    ]);
    if (count($user) > 0) {
        return "Diese Email ist bereits vergeben.";
    }
    return "";
}
