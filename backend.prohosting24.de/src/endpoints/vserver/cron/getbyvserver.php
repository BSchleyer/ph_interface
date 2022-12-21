<?php


if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$cron = new VServerCron($dependencyInjector, null);
$cronJobs = $cron->getAll(["vserverid" => $_POST["id"], "status" => 1], true);

$respond = [];

foreach ($cronJobs as $job){
    $respond[] = [
        "id" => $job["id"],
        "name" => $job["name"],
        "action" => $job["action"],
        "command" => $job["command"],
        "next_run" => niceDate($job["next_run_at"]),
        "last_run" => niceDate($job["last_run_at"]),
        "created_on" => niceDate($job["created_on"]),
        "minute" => $job["cron_minute"],
        "hour" => $job["cron_hour"],
        "day_month" => $job["cron_day_of_month"],
        "month" => $job["cron_month"],
        "day_week" => $job["cron_day_of_week"]
    ];
}

$response->setresponse($respond);