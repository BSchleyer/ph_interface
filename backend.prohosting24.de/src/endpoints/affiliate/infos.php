<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$user = new User();
if (!$user->load_id($dependencyInjector->getDatabase(), $_POST["userid"])) {
	$dependencyInjector->getResponse()->fail(200, "Not Found");
};

$affiliate = new AffiliateLink($dependencyInjector, null);
$affiliates = $affiliate->getAll(["userid" => $user->getId()], false);
$links = [];
$ids = [];
$clicks = 0;
foreach ($affiliates as $affiliate) {
	$tmp = [];
	$tmp["id"] = $affiliate->getValue("id");
	$tmp["userid"] = $affiliate->getValue("userid");
	$tmp["link"] = htmlspecialchars($affiliate->getValue("link"));
	$tmp["created_on"] = niceDate($affiliate->getValue("created_on"));
    $tmp["clicks"] = $affiliate->getLinkCount();
    $clicks = $clicks + $affiliate->getLinkCount();
    $links[] = $tmp;
    $ids[] = $tmp["id"];
}

$registercount = $masterdatabase->count("main_user", [
    "affiliatelink[=]" => $ids
]);;
$payout = new AffiliatePayout($dependencyInjector,null,null);
$payout = $payout->getAll(["linkid" => $ids],true);
$payouts = [];
$payoutamount = 0;
foreach ($payout as $entry) {
    $tmp = [];
    $tmp["amount"] = $entry["amount"];
    $payoutamount = $payoutamount + $entry["amount"];
    $tmp["created_on"] = niceDate($entry["created_on"]);
    $payouts[] = $tmp;
}

$response->setresponse([[$links,$payouts],[$registercount,$clicks,$payoutamount]]);