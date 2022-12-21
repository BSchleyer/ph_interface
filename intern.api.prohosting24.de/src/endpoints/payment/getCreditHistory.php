<?php

defined('RZGvsletoIujWnzKrNyB') or die();


$apirespond = requestBackend($config, ["userid" => $user->getID()], "getguthabenhistory");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$returnHTML = "";

foreach ($apirespond["response"] as $data) {
    $returnHTML .= "<tr><td>".$data["id"]."</td><td>".$data["change"]."</td><td>".$data["reason"]."</td><td>".$data["created_on"]."</td></tr>";
}

$response->setresponse(minifyhtml($returnHTML));
