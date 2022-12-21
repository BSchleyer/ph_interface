<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "entryType","entryName", "entryContent", "oldName"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$domain = new DomainNew($dependencyInjector, $_POST["id"]);

$nameserver = new Nameserver($dependencyInjector);

$nameserver->updateRecord($domain->getDomainName(),$_POST["entryContent"],120,$_POST["entryName"],$_POST["oldName"],$_POST["entryType"]);
