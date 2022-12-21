<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["email", "password", "length", "ip", "browser","secret"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$ratelimit = new RateLimit($masterdatabase);

if ($ratelimit->check("login", null, $_POST["ip"])) {
    $response->setfail(true, $dependencyInjector->getLang()->getString("wronginformationtoooften"));
    return;
}

$loginuser = new User();


$getinfo = $loginuser->load_email(strtolower($_POST["email"]), $masterdatabase);

if (!$getinfo) {
    
    $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
    $response->setfail(true, $dependencyInjector->getLang()->getString("wronginformation"));
    return;
}


$checkpassord = $loginuser->checkpassword($_POST["password"]);
if (!$checkpassord) {
    
    $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
    $response->setfail(true, $dependencyInjector->getLang()->getString("wronginformation"));
    return;
}

if ($loginuser->getStatus() == 1) {
    
    $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
    $response->setfail(true, $dependencyInjector->getLang()->getString("accountsuspended"));
    return;
}

if ($loginuser->getStatus() == 2) {
    
    $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
    $response->setfail(true, $dependencyInjector->getLang()->getString("accountdeactivated"));
    return;
}

if ($loginuser->getStatus() == 3) {
    
    $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
    $response->setfail(true, $dependencyInjector->getLang()->getString("wronginformation"));
    return;
}

if ($loginuser->getStatus() == 4) {
    
    
    $loginuser->updatetonewpw($masterdatabase, $_POST["password"]);
}

if ($loginuser->getStatus2fa() != 0) {
    
    if($_POST["secret"] == "0"){
        $response->fail(true, "2fa");
    }

    $tfa = new \RobThree\Auth\TwoFactorAuth('Prohosting24');
    if(!$tfa->verifyCode($loginuser->getSecret(),$_POST["secret"])){
        
        $code = new User2faBackupCode($dependencyInjector, null);
        if(!$code->checkBackupCode($_POST["secret"], $loginuser->getID())){
            $ratelimit->add("login", null, $_POST["ip"], 10, "30 minutes");
            $response->fail(true, "2fa code falsch");
        }
    }
}


$sessionid = $loginuser->newsession($masterdatabase, $_POST["length"], $_POST["ip"]);
if ($loginuser->getLoginemail() == "1") {
    $mail = new Mail($masterdatabase, $config);
    $mail->addmail("main_login", $loginuser->getID(), ["name" => $loginuser->getVorname() . " " . $loginuser->getNachname(), "ip" => $_POST["ip"], "browser" => htmlspecialchars($_POST["browser"])]);
}
$response->setresponse($sessionid);
