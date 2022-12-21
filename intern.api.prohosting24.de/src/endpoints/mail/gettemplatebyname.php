<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, [], "gettemplates");

foreach ($apirespond["response"] as $template) {
    if ($template["name"] == $_POST["name"]) {
        $apirespond = requestBackend($config, ["id" => $template["id"]], "gettemplate");
        $response->setresponse($apirespond["response"]);
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}
$response->setfail(true, $apirespond["error"]);
print_r(json_encode($response->getresponsearray()));
die();
