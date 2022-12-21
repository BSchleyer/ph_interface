<?php

defined('RZGvsletoIujWnzKrNyB') or die();


$result = requestBackend($config, ["userid" => $user->getId()], "getDonationsByUserId");


if (isset($result["error"])) {
    
    $response->setfail(true, $result["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($result["response"]);
