<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$domain = new Domain($masterdatabase, $config);

$domainInfo = $domain->getDomainInfoById($_POST["id"]);

if(count($domainInfo) == 0){
    $response->fail(true, "Domain nicht gefunden.");
}

$domainName = $domainInfo["sld"] . "." . $domainInfo["tld"];

$mailbox = new MailBox($dependencyInjector);

$res = $mailbox->getByTLD($domainName);

$result = [];

foreach ($res as $entry) {
    $result[] = ["local_part" => $entry["local_part"]];
}

$response->setresponse($result);
