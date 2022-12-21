<?php


if (!checkpost($_POST, ["cronid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$cron = new VServerCron($dependencyInjector, $_POST["cronid"]);
$cron->setValue("status", 0);
$cron->update();

$response->setresponse("");