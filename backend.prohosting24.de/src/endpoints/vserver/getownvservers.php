<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$services = $masterdatabase->select("service_main", [
    "[>]vserver_main" => ["serviceid" => "id"],
], [
    "service_main.expire_at",
    "service_main.delete_at",
    "service_main.serviceid",
    "vserver_main.id",
    "vserver_main.cores",
    "vserver_main.memory",
    "vserver_main.disk",
], [
    "service_main.userid" => $_POST["userid"],
    "service_main.produktid" => 1,
    "hide" => 0,
    "ORDER" => ["service_main.id" => "ASC"],
]);

foreach ($services as $key => $vserver) {
    
    $serverqueue = $masterdatabase->select("vserver_queue", [
        "id",
        "action",
    ], [
        "serverid" => $vserver["id"],
        "done" => 0,
    ]);
    if ((strtotime($vserver["expire_at"]) - time()) < 0) {
        if ($vserver["delete_at"] != null) {
            if ((strtotime($vserver["delete_at"]) - time()) < 0) {
                $services[$key]["status"] = "deleted";
            } else {
                $services[$key]["status"] = "expired";
            }
        } else {
            $services[$key]["status"] = "expired";
        }
    } else {
        if (count($serverqueue) != 0) {
            
            if (in_array($serverqueue[0]["action"], [1, 2, 3, 6])) {
                $services[$key]["status"] = "Installation";
            } else {
                $services[$key]["status"] = "stopped";
            }
        } else {
			$vservertmp = new VServer($dependencyInjector);
			$vservertmp->loadwithid($vserver["id"]);
			$services[$key]["status"] = $vservertmp->getcurrent()["data"]["status"];
		}
    }
    $services[$key]["delete_at"] = strtotime($vserver["delete_at"]);
    $services[$key]["timeleft"] = strtotime($vserver["expire_at"]);
}

$response->setresponse($services);
