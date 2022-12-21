<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["name", "hostname", "ip", "username", "password"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$newnode = New Node($dependencyInjector);

$newnode->setName($_POST["name"]);
$newnode->setIp($_POST["ip"]);
$newnode->setHostname($_POST["hostname"]);
$newnode->setUsername($_POST["username"]);
$newnode->setPassword(encrypt_decrypt("encrypt", $_POST["password"], $this->config->getconfigvalue("key"), $this->config->getconfigvalue("key")));

if (!$newnode->create($masterdatabase)) {
    $response->setfail(true, "Database Error while creating the Node");
    return;
}
