<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["code"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$apirespond = requestBackend($config, ["userid" => $user->getID(), "code" => $_POST["code"]], "redeemcode");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
