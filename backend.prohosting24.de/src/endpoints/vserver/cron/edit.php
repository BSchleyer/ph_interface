<?php


if (!checkpost($_POST, ["vserverid", "minute", "hour", "day_month", "month", "day_week", "action", "name", "cronid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$cron = new VServerCron($dependencyInjector, $_POST["cronid"]);

switch ($_POST["action"]){
    case 'start':
    case 'stop':
    case 'reset':
    case 'shutdown':
    case 'backup':
        break;
    case 'command':
        if (!checkpost($_POST, ["command"])) {
            $response->setfail(true, "Missing Variable in POST");
            return;
        }
        break;
    default:
        $response->fail(1, $dependencyInjector->getLang()->getString("cronnovalidoption"));
        break;
}

try {
    new Cron\CronExpression($_POST["minute"] . " " . $_POST["hour"]. " " . $_POST["day_month"]. " " . $_POST["month"]. " " . $_POST["day_week"]);
}catch (Exception $e){
    $response->fail(1, $dependencyInjector->getLang()->getString("cronnovalidcron"));
}
$cron->setValue("name", htmlspecialchars($_POST["name"]));
$cron->setValue("action", $_POST["action"]);
if($_POST["action"] == "command"){
    $cron->setValue("command", $_POST["command"]);
}
$cron->setValue("cron_minute", $_POST["minute"]);
$cron->setValue("cron_hour", $_POST["hour"]);
$cron->setValue("cron_day_of_month", $_POST["day_month"]);
$cron->setValue("cron_month", $_POST["month"]);
$cron->setValue("cron_day_of_week", $_POST["day_week"]);
$cron->update();

$response->setresponse($cron->getValue("id"));