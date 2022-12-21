<?php

defined('RZGvsletoIujWnzKrNyB') or die();


if (!checkpost($_POST, ["code"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, ["userid" => $user->getId(), "code" => $_POST["code"]], "remove2fa");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
