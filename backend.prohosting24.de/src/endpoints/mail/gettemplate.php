<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$mail = new Mail($masterdatabase, $config);

$templates = $mail->gettemplate($_POST["id"]);

$response->setresponse($templates);
