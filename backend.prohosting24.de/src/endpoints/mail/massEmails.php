<?php


foreach ($data as $user) {
    $mail = new Mail($masterdatabase, $config);
    $mail->addmail("topupcampaign", $user["id"], []);
}