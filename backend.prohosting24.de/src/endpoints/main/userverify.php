<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["sessionid", "ip"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$check = $masterdatabase->select("main_user_sessions", "*", [
    "session_token" => $_POST["sessionid"],
    
]);
if (count($check) != 1) {
    $response->setfail(true, "Keine Valide SessionId.");
    return;
}

$userverify = new User();

$userverify->load_sessionid($masterdatabase, $_POST["sessionid"]);

if ($userverify->getStatus() == 1) {
    
    $response->setfail(true, "Dieser Account wurde gesperrt");
    return;
}

if ($userverify->getStatus() == 2) {
    
    $response->setfail(true, "Dieser Account wurde deaktiviert");
    return;
}

if ($userverify->getStatus() == 3) {
    
    $response->setfail(true, "Keine Valide SessionId.");
    return;
}

$userverify->loadUserRights($masterdatabase);

$userinfo["id"] = $userverify->getID();
$userinfo["username"] = htmlspecialchars($userverify->getUsername());
$userinfo["vorname"] = htmlspecialchars($userverify->getVorname());
$userinfo["nachname"] = htmlspecialchars($userverify->getNachname());
$userinfo["guthaben"] = $userverify->getGuthaben();
$userinfo["email"] = htmlspecialchars($userverify->getEmail());
$userinfo["groups"] = $userverify->getGroups();
$userinfo["rights"] = $userverify->getRights();
$userinfo["ishourly"] = $userverify->getIshourly();
$userinfo["canhourly"] = $userverify->getCanhourly();
$userinfo["apikey"] = $userverify->getApikey();
$userinfo["loginemail"] = $userverify->getLoginemail();
$userinfo["created_on"] = niceDate($userverify->getCreated_on());
$userinfo["status"] = $userverify->getStatus();
$userinfo["supportpin"] = $userverify->getSupportPin();
$userinfo["secret"] = $userverify->getStatus2fa();
$userinfo["newsletter"] = $userverify->getNewsletter();
$userinfo["lang"] = $userverify->getLang();
$userinfo["inviteCode"] = $userverify->getInviteCode();
$userinfo["creditLimit"] = $userverify->getCreditLimit();
$userinfo["darkmode"] = $userverify->getDarkMode();

if($userinfo["inviteCode"] == null){
    $code = rand(100,999) . "-" . rand(100,999) . "-" .rand(100,999) . "-" . rand(100,999);
    $userinfo["inviteCode"] = $code;
    $userverify->updateInviteCode($masterdatabase, $code);
}

if ($userinfo["supportpin"] == 0) {
    $userinfo["supportpin"] = random_str(5, "0123456789");
    $userverify->setSupportPin($userinfo["supportpin"]);
    $userverify->save("supportpin", $masterdatabase);
}
$currenttime = date('Y-m-d H:i:s', time());

$userinfo["servicecount"] = $masterdatabase->count("service_main", [
    "userid" => $userverify->getID(),
    "expire_at[>]" => $currenttime,
    "delete_done[=]" => 0,
    "hide" => 0,
]);
$userinfo["ticketcount"] = $masterdatabase->count("ticket_main", [
    "userid" => $userverify->getID(),
    "status[!]" => [3, 4],
]);
$userinfo["domaincount"] = $masterdatabase->count("service_main", [
    "userid" => $userverify->getID(),
    "expire_at[>]" => $currenttime,
    "delete_done[=]" => 0,
    "hide" => 0,
    "produktid" => 4,
]);

$monthlycost = $masterdatabase->select("service_main", [
    "price",
    "discount",
], [
    "userid" => $userverify->getID(),
    "expire_at[>]" => $currenttime,
    "delete_done[=]" => 0,
    "hide" => 0,
    "produktid" => [1, 2, 3],
]);
$userinfo["monthlycost"] = 0;
foreach ($monthlycost as $cost) {
    $userinfo["monthlycost"] += $cost["price"] * (1 - $cost["discount"]);
}
$userinfo["monthlycost"] = round($userinfo["monthlycost"], 2);



$response->setresponse($userinfo);
