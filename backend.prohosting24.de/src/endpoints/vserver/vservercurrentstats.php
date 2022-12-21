<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
if (isset($_POST["sessionid"])) {
    $userid = $masterdatabase->select("main_user_sessions", [
        "userid",
    ], [
        "session_token" => $_POST["sessionid"],
    ]);
    if (count($userid) != 1) {
        $response->setfail(true, "Session Invalid");
        return;
    }
    $userid = $userid[0]["userid"];
    $serverinfo = $masterdatabase->select("service_main", [
        "userid",
        "id"
    ], [
        "serviceid" => $_POST["id"],
        "produktid" => 1,
	]);
	if (count($serverinfo) != 1) {
		$response->setfail(true, "Server Invalid");
		return;
	}
	if ($userid != $serverinfo[0]["userid"]) {
	    $access = new AccessUser($dependencyInjector, null);
	    $access = $access->getAll(["serviceid" => $serverinfo[0]["id"], "status" => 1]);
        $found = false;
	    foreach ($access as $entry){
	        if($entry->getValue("userid") == $userid){
	            $found = true;
            }
        }
	    if(!$found){
            $response->setfail(true, "Nicht Ihr KVM Server");
            return;
        }
	}
}
$vservertmp = new VServer($dependencyInjector);
$vservertmp->loadwithid($_POST["id"]);

$tmparray = $vservertmp->getcurrent();


$responsearray = [];
if (!isset($tmparray["data"]["cpu"])) {
    $tmparray = $vservertmp->getcurrent();
    if (!isset($tmparray["data"]["cpu"])) {
        $responsearray["cpu"] = 0;
    } else {
        $responsearray["cpu"] = round($tmparray["data"]["cpu"] * 100,2);
    }
} else {
	$responsearray["cpu"] = round($tmparray["data"]["cpu"] * 100,2);
}

if (!isset($tmparray["data"]["mem"])) {
    $responsearray["mem"] = 0;
} else {
    $responsearray["mem"] = $tmparray["data"]["mem"];
}

$response->setresponse($responsearray);
