<?php



$tasklist = $masterdatabase->select("vserver_task", [
	"id",
	"vserverid",
	"proxmoxid",
], [
	"done" => 0,
]);
$vserver = new VServer($dependencyInjector);
foreach ($tasklist as $task) {
	$vserver->loadwithid($task["vserverid"]);
	$vserver->checktask($task["proxmoxid"]);
}
