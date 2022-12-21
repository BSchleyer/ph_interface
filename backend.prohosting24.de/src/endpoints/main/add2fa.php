<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
use \RobThree\Auth\TwoFactorAuth;

$tfa = new TwoFactorAuth('Prohosting24');

$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);


if(isset($_POST["code"])){
    if(!$tfa->verifyCode($user->getSecret(),$_POST["code"])){
        $response->fail(true, "2fa code falsch");
    }
    $user->verify2fa($masterdatabase);
    $user->deletesessions($masterdatabase);
    $response->setresponse("");
    return;
}

$code = new User2faBackupCode($dependencyInjector, null);
$code->invalidAllCodes($_POST["userid"]);
$code->createCodes($_POST["userid"]);

$codes = $code->getAll(["userid" => $_POST["userid"], "status" => 1], true);

$secret = $tfa->createSecret(160);

$qrcode = $tfa->getQRCodeImageAsDataUri($user->getEmail(), $secret);

$code = $tfa->getCode($secret);

$user->add2fa($secret,$masterdatabase);

$response->setresponse([$qrcode,$secret,$codes]);
