<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
$currenttime = date('Y-m-d H:i:s', time());

$serviceinfos = $masterdatabase->select("service_main", [
    "id",
    "produktid",
    "serviceid",
], [
    "expire_at[<]" => $currenttime,
    "delete_done[=]" => 0,
    "produktid" => 1,
    "hourly" => 0,
]);

foreach ($serviceinfos as $service) {
	$vserver = new vServer($dependencyInjector);
	$vserver->loadwithid($service["serviceid"]);
	$vserver->stop();
}
