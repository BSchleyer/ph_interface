<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (isset($_POST["userid"])) {
    if (!$user->checkright(2)) {
        
        $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    $apirespond = requestBackend($config, ["userid" => $_POST["userid"]], "getguthabenhistory");
} else {
    $apirespond = requestBackend($config, ["userid" => $user->getId()], "getguthabenhistory");
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
