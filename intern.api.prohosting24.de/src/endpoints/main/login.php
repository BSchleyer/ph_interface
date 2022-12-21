<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["email", "password", "length", "secret"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$fields = [
    'length' => $_POST["length"],
    'email' => $_POST["email"],
    'password' => $_POST["password"],
    'ip' => getclientip(),
    'browser' => $_SERVER['HTTP_USER_AGENT'],
];

if(!isset($_POST["secret"])) {
    $fields["secret"] = "0";
} else {
    $fields["secret"] = $_POST["secret"];
}

if(!isset($_POST["lang"])) {
    global $selectedLang;
    $selectedLang = "de";
} else {
    global $selectedLang;
    $selectedLang = "en";
}

$apirespond = requestBackend($config, $fields, "loginuser");

if ($apirespond["fail"] == 1) {
    $response->setfail(true, $apirespond["error"]);
    return;
}

$response->setresponse($apirespond["response"]);
