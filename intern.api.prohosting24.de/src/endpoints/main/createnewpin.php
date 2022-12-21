<?php

defined('RZGvsletoIujWnzKrNyB') or die();


$apirespond = requestBackend($config, ["sessionid" => $user->getSessionid()], "createnewpin");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
