<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "username"])) {
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

$res = $mailbox->delete($_POST["username"], $domainName);


if(count($res) != 1){
    $response->fail(true, "Beim löschen der Mailbox ist ein Fehler aufgetreten.");
}
if(isset($res[0]["msg"][0])){
    if($res[0]["msg"][0] == "domain_removed"){
        $response->setresponse("Löschen erfolgreich.");
        return;
    }
    $response->fail(true, "Beim löschen der Mailbox ist ein Fehler aufgetreten.");
}
$response->fail(true, "Beim löschen der Mailbox ist ein Fehler aufgetreten.");