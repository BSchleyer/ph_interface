<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid", "code"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);

$tfa = new \RobThree\Auth\TwoFactorAuth('Prohosting24');
if(!$tfa->verifyCode($user->getSecret(),$_POST["code"])){
    
    $code = new User2faBackupCode($dependencyInjector, null);
    if(!$code->checkBackupCode($_POST["code"], $user->getID())){
        $response->fail(true, "2fa code falsch");
    }
}

$user->remove2fa($masterdatabase);