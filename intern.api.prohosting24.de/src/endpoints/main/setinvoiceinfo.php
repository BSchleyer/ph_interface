<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, [ "street", "house_number", "plz","city","country"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$data = ["userid" => $user->getId(), "street" => $_POST["street"], "country" => $_POST["country"], "house_number" => $_POST["house_number"], "plz" => $_POST["plz"], "city" => $_POST["city"]];

if(isset($_POST["company_name"])){
    $data["company_name"] = $_POST["company_name"];
}


$apirespond = requestBackend($config, $data, "setinvoiceinfo");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
