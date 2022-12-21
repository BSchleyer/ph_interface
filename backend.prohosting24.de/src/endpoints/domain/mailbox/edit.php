<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "username", "password"])) {
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

$res = $mailbox->edit($domainName, $_POST["username"], $_POST["password"]);
if(count($res) != 1){
    $response->fail(true, "Beim bearbeiten der MailBox ist ein Fehler aufgetreten.");
}
if(isset($res[0]["msg"][0])){
    if($res[0]["msg"][0] == "mailbox_modified"){
        $response->setresponse("MailBox erfolgreich bearbeitet.");
        return;
    }
    if($res[0]["msg"] == "password_complexity"){
        $response->fail(true, "Das Passwort erfüllt nicht die Anforderungen");
        return;
    }
}
$response->fail(true, "Beim bearbeiten der MailBox ist ein Fehler aufgetreten.");
