<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "username", "name"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$domain = new Domain($masterdatabase, $config);

$domainInfo = $domain->getDomainInfoById($_POST["id"]);

if(count($domainInfo) == 0){
    $response->fail(true, "Domain nicht gefunden.");
}
if(strlen($_POST["username"]) > 32){
    $response->fail(true, "Der Nutzername darf nur 32 Zeichen enthalten.");
    return;
}

$domainName = $domainInfo["sld"] . "." . $domainInfo["tld"];

$mailbox = new MailBox($dependencyInjector);

$password = random_str(20);

$res = $mailbox->create($domainName, checkString($_POST["username"]), $password, checkString($_POST["name"],"0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .-"));

if(is_string($res)){
    $response->fail(true, $res);
}

if(count($res) != 1){
    $response->fail(true, "Beim erstellen der MailBox ist ein Fehler aufgetreten.");
}
if(isset($res[0]["msg"][0])){
    if($res[0]["msg"][0] == "mailbox_added"){
        $response->setresponse([checkString($_POST["username"]), $password]);
        return;
    }
}
$response->fail(true, "Beim erstellen der MailBox ist ein Fehler aufgetreten.");
