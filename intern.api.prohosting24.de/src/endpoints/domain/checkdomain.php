<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["domain"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
if (isset($_POST["all"])) {
    $apirespond = requestBackend($config, ["name" => $_POST["domain"], "all" => $_POST["all"]], "checkdomain");
} else {
    $apirespond = requestBackend($config, ["name" => $_POST["domain"]], "checkdomain");
}
if(!isset($apirespond["fail"])){
    $response->setfail(true, $lang->getString("domainerrornodomain"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

if($apirespond["fail"]){
    if ($apirespond["fail"] == 500) {
        
        $response->setfail(true, $apirespond["error"]);
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}
$response->setresponse($apirespond["response"]);
