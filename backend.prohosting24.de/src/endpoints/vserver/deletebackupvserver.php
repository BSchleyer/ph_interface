<?php





if (!checkpost($_POST, ["name", "id"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}
$vserver = New VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);



if (strpos($_POST["name"], $vserver->getproxmoxid() . '/') !== false) {
	$backups = $vserver->deletebackup($_POST["name"]);
	$response->setresponse($backups);
	return;
}
