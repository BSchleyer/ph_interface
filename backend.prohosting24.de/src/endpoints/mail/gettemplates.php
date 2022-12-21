<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$mail = new Mail($masterdatabase, $config);

$templates = $mail->gettemplates();

$response->setresponse($templates);
