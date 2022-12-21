<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$services = $masterdatabase->select("service_main", [
    "[>]webspace_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "webspace_main.id",
    "webspace_main.pleskid",
    "webspace_main.domain",
    "webspace_main.guid",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 2,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $webspace) {
    if ((strtotime($webspace["expire_at"]) - time()) < 0) {
        if ($webspace["delete_at"] != null) {
            if ((strtotime($webspace["delete_at"]) - time()) < 0) {
                $services[$key]["status"] = "deleted";
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $services[$key]["status"] = "expired";
        }
    } else {
        $services[$key]["status"] = "running";
    }
    $services[$key]["delete_at"] = strtotime($webspace["delete_at"]);
    $services[$key]["timeleft"] = strtotime($webspace["expire_at"]);
}

$response->setresponse($services);
