<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "link"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$user = new User();
if (!$user->load_id($dependencyInjector->getDatabase(), $_POST["id"])) {
	$dependencyInjector->getResponse()->fail(200, "Not Found");
}

$link = new AffiliateLink($dependencyInjector, null);

$allowed = str_split("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
$linkSplit = str_split($_POST['link']);

foreach ($linkSplit as $entry) {
	if(!in_array($entry,$allowed)){
		$dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_blacklistchar);	
	}
}

$link->setValue("link", $_POST["link"]);
$link->setValue("userid", $user->getId());
$link->checkLink();
$link->create();