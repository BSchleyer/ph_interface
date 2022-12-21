<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["username", "email", "password", "vorname", "nachname", "lang"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$ratelimit = new RateLimit($masterdatabase);
$newuser = new User();
$usernamecheck = checkusername($_POST["username"], $masterdatabase);
if ($usernamecheck != "") {
    $response->setfail(true, $usernamecheck);
    return;
}
$emailcheck = checkemail($_POST["email"], $masterdatabase);
if ($emailcheck != "") {
    $response->setfail(true, $emailcheck);
    return;
}
if ($ratelimit->check("register", null, $_POST["ip"])) {
    $response->setfail(true, "Sie haben sich bereits registriert.");
    return;
}
$newuser->setUsername($_POST["username"]);
$newuser->setEmail(strtolower($_POST["email"]));
$newuser->setPassword($_POST["password"]);
$newuser->setVorname($_POST["vorname"]);
$newuser->setNachname($_POST["nachname"]);

$lang = new Language($dependencyInjector, null);

$langList = $lang->getAll(["lang" => $_POST["lang"]]);
if(count($langList) != 1){
    $response->setfail(true, "Bitte wählen Sie eine Sprache aus.");
    return;
}
$newuser->setLang($_POST["lang"]);

$affiliate = false;
if(isset($_POST["affiliate"])){
    $link = new AffiliateClick($dependencyInjector,null,null);

    $links = $link->getAll(["cookie" => $_POST["affiliate"]],true);
    if(count($links) != 0){
        $newuser->setAffiliatelink($links[0]["linkid"]);
        $affiliate = true;
        
    }
}

if (!$newuser->createuser($masterdatabase)) {
    $response->setfail(true, "Datenbank Fehler bei der Registrierung des Kundenaccounts");
    unset($_POST["password"]);
    Functions::errorLog("systemRegisterError", "Register Error", $_POST);
    return;
}

$userInfo = new UserNew($dependencyInjector, strtolower($_POST["email"]), "email");
$fields = [];
if($affiliate){
    $fields = [
        [
            "name" => "Affiliate Cookie",
            "value" => $_POST["affiliate"]
        ],
        [
            "name" => "Affiliate Link",
            "value" => $links[0]["linkid"]
        ]
    ];
}

Functions::sendDataToDiscordFeed("👥 Neuer Kunde", "Der Nutzer " . $userInfo->getValue("username") . " hat sich gerade mit der Email " . $userInfo->getValue("email") . " registiert.", "https://prohosting24.de/admin/kunden/" . $userInfo->getValue("id"),$fields);




if ($_POST["sessionid"] == 1) {
    $ratelimit->add("register", null, $_POST["ip"], 1, "1 day");
    $newuser->load_email($_POST["email"], $masterdatabase);
    $masterdatabase->insert("main_user_to_group", [
        "userid" => $newuser->getID(),
        "groupid" => 2,
    ]);

    $sessionid = $newuser->newsession($masterdatabase, 10, $_POST["ip"]);

    $response->setresponse($sessionid);
}
