<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["email", "ip"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$ratelimit = new RateLimit($masterdatabase);

if ($ratelimit->check("passwordforgot", null, $_POST["ip"])) {
    $response->setfail(true, "Sie haben zu oft versucht Ihr Passwort wiederherzustellen.");
    return;
}
$usera = $masterdatabase->select("main_user", [
    "id",
], [
    "email" => strtolower($_POST["email"]),
]);
if (count($usera) == 1) {
    $user = new User();
    $user->load_id($masterdatabase, $usera[0]["id"]);
    if ($user->getStatus() == 1) {
        
        $response->setresponse("");
        return;
    }
    if ($user->getStatus() == 2) {
        
        $response->setresponse("");
        return;
    }
    if ($user->getStatus() == 3) {
        
        $response->setresponse("");
        return;
    }
    $link = new ExternLink($masterdatabase, $config);
    $link = $link->addlink($user->getID(), "passwordforgot");
    $mail = new Mail($masterdatabase, $config);
    $mail->addmail("main_passwortvergessen", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "link" => $link]);
}
$ratelimit->add("passwordforgot", null, $_POST["ip"], 3, "120 minutes");
$response->setresponse("");
