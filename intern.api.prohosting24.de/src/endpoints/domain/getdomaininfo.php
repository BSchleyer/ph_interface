<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getdomainowner");
$apirespond = requestBackend($config, ["serviceid" => $_POST["id"]], "getdomaininfo");
if ($ownerid["response"] != $user->getID()) {
    if(!in_array($user->getID(), $apirespond["response"]["accessUsers"])){
        $response->setfail(true, $lang->getString("domainerrornotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
$response->setresponse($apirespond["response"]);
