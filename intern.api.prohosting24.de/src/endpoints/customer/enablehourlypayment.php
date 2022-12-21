<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if ($user->getCanhourly() == 0) {
    $response->setfail(true, $lang->getString("enablehourlypaymentpermissionerror"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid()], "enablehourlypayment");
if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
