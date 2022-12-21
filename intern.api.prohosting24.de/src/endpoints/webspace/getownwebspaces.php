<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$apirespond = requestBackend($config, ["userid" => $user->getId()], "getownwebspaces");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$response->setresponse($apirespond["response"]);
