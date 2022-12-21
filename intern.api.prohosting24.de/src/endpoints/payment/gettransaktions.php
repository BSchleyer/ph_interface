<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!$user->checkright(43)) {
    $response->setfail(true, $lang->getString("permissionerrornotenoughrights"));
    print_r(json_encode($response->getresponsearray()));
    die();
}
if (isset($_POST["userid"])) {
    $apirespond = requestBackend($config, ["userid" => $_POST["userid"]], "gettransaktions");
} else {
    $apirespond = requestBackend($config, [], "gettransaktions");
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    return;
}
$response->setresponse($apirespond["response"]);
