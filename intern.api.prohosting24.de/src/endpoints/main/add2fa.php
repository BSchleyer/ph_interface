<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$info = ["userid" => $user->getId()];

if(isset($_POST["code"])){
    $info["code"] = $_POST["code"];
}


$apirespond = requestBackend($config, $info, "add2fa");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$response->setresponse($apirespond["response"]);
