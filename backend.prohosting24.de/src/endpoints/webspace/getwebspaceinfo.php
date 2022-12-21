<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$webspaces = $masterdatabase->select("service_main", [
    "[>]webspace_main" => ["serviceid" => "id"],
    "[>]webspace_packages" => ["webspace_main.package" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "service_main.discount",
    "service_main.status",
    "service_main.name",
    "webspace_main.id",
    "service_main.id(serviceidnew)",
    "service_main.userid",
    "webspace_main.pleskid",
    "webspace_main.domain",
    "webspace_main.package",
    "webspace_main.guid",
    "service_main.price",
    "service_main.autorenew",
    "webspace_packages.speicher",
    "webspace_main.created_on",
], [
    "service_main.produktid" => 2,
    "webspace_main.id" => $_POST["id"],
]);

if ($webspaces[0]["status"] == 1) {
    $response->setfail(true, "Dieser Service ist gesperrt.");
    return;
}

foreach ($webspaces as $key => $webspace) {
    $access = new AccessUser($dependencyInjector, null);
    $access = $access->getAll(["serviceid" => $webspace["serviceidnew"], "status" => 1]);
    $accessList = [];

    foreach ($access as $accessEntry){
        $accessList[] = $accessEntry->getValue("userid");
    }
    $webspaces[$key]["accessUsers"] = $accessList;
    $webspaces[$key]["price"] = $webspace["price"] * (1 - $webspace["discount"]);
    if ((strtotime($webspace["expire_at"]) - time()) < 0) {
        if ($webspace["delete_at"] != null) {
            if ((strtotime($webspace["delete_at"]) - time()) < 0) {
                $webspaces[$key]["status"] = "deleted";
            } else {
                $webspaces[$key]["status"] = "expired";
            }
        } else {
            $webspaces[$key]["status"] = "expired";
        }
    } else {
        $webspaces[$key]["status"] = "running";
    }
    $webspaces[$key]["timeleft"] = strtotime($webspace["expire_at"]);
    $webspaces[$key]["timeleftdelete"] = strtotime($webspace["delete_at"]);
    $webspacet = new Webspace($masterdatabase, $config);
    try {
        $diskusage = $webspacet->getwebspacediskusage($webspace["serviceid"]);
    }catch (Exception $e){
       $response->fail(1,"Error");
    }
    $usage = 0;
    foreach ($diskusage as $disk) {
        $usage = $usage + $disk;
    }
    $webspaces[$key]["diskusage"] = round($usage / 1000000000, 3);
    if(!isset($webspace["name"])){
        $webspaces[$key]["name"] = "#" . $webspace["id"];
    } else {
        $webspaces[$key]["name"] = htmlspecialchars($webspace["name"]);
    }
}

$response->setresponse($webspaces[0]);
