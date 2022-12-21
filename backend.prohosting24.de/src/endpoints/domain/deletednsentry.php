<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["entryName","id", "entryType"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$domain = new DomainNew($dependencyInjector, $_POST["id"]);


$nameserver = new Nameserver($dependencyInjector);

$nameserver->deleteRecord($domain->getDomainName(),$_POST["entryName"],$_POST["entryType"]);
