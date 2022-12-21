<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["ip", "link", "url"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$ratelimit = new RateLimit($masterdatabase);

if ($ratelimit->check("affiliateclick", null, $_POST["ip"])) {
    $response->setfail(true, "Zu viele Anfragen.");
    return;
}

$ratelimit->add("affiliateclick", null, $_POST["ip"], 1, "30 minutes");

$affiliateLink = new AffiliateLink($dependencyInjector, $_POST["link"], "link");
$cookie = random_str(20);
$click = new AffiliateClick($dependencyInjector, null, null);
$click->setValue("linkid", $affiliateLink->getValue("id"));
$click->setValue("link", $_POST["url"]);
$click->setValue("ip", $_POST["ip"]);
$click->setValue("cookie", $cookie);
$click->create();

$response->setresponse($cookie);