<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["code", "userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$discount = new Discount($masterdatabase, $config);
$ratelimit = new RateLimit($masterdatabase);

if ($ratelimit->check("redeemcode", null, $_POST["userid"])) {
    $response->setfail(true, "Sie haben zu oft falsche Informationen angegeben.");
    return;
}
if ($discount->loadwithcode($_POST["code"]) == 404) {
    $ratelimit->add("redeemcode", null, $_POST["userid"], 10, "180 minutes");
    $response->setfail(true, "Dieser Code existiert nicht");
    return;
}

if ($discount->gettype() == 2 || $discount->gettype() == 3) {
    $ratelimit->add("redeemcode", null, $_POST["userid"], 10, "180 minutes");
    $response->setfail(true, "Dieser Code existiert nicht");
    return;
}
if ($discount->redeem($_POST["userid"]) == 400) {
    $response->setfail(true, "Dieser Code kann nicht mehr verwendet werden");
    return;
}
