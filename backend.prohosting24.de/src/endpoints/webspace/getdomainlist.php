<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["webspaceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$webspace = new Webspace($masterdatabase, $config);

$respond = $webspace->getDomains($_POST["webspaceid"]);

$respond = json_decode(json_encode($respond),true);
$formatedResponse = [];

if(isset($respond["domains"]["domain"]["id"])){
    foreach ($respond["domains"] as $domainEntry){

        if($domainEntry["main"] == "true"){
            $domainEntry["main"] = 1;
        } else {
            $domainEntry["main"] = 0;
        }

        $formatedResponse[] = [
            "name" => $domainEntry["name"],
            "id" => $domainEntry["id"],
            "main" => $domainEntry["main"],
        ];
    }
} else {
    foreach ($respond["domains"]["domain"] as $domainEntry){

        if($domainEntry["main"] == "true"){
            $domainEntry["main"] = 1;
        } else {
            $domainEntry["main"] = 0;
        }

        $formatedResponse[] = [
            "name" => $domainEntry["name"],
            "id" => $domainEntry["id"],
            "main" => $domainEntry["main"],
        ];
    }
}



$response->setresponse($formatedResponse);
