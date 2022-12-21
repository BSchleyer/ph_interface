<?php

defined('RZGvsletoIujWnzKrNyB') or die();


$apirespond = requestBackend($config, ["userid" => $user->getID()], "getemailsbyuserid");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$returnHTML = "";

foreach ($apirespond["response"] as $data) {
    $returnHTML .= "<tr><td>".$data["id"]."</td><td>".$data["title"]."</td><td>".$data["created_on"]."</td><td><button type=\"button\" class=\"btn btn-primary\" onclick=\"openEmail(".$data["id"].")\" >" .$lang->getString("show")."</button></td></tr>";
}

$response->setresponse(minifyhtml($returnHTML));
