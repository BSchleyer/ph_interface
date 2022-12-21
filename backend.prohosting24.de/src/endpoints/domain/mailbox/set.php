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

$dkim = $mailbox->getDKIM($domainName)["dkim_txt"];

$ns = new Nameserver($dependencyInjector);



$ns->addrecord($domainName,"MX", "0 mail.promailserver24.eu.",120,$domainName .".");
$ns->addrecord($domainName,"TXT",'"?v=spf1mx-all"',120,$domainName . ".");
$ns->addrecord($domainName,"TXT",'"' . $dkim . '"',120,"dkim._domainkey."  . $domainName . ".");