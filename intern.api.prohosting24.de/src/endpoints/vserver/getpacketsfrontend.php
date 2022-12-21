<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (isset($_POST["id"])) {
    $apirespond = requestBackend($config, ["id" => $_POST["id"]], "getpackets");
} else {
    $apirespond = requestBackend($config, [], "getpackets");
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
