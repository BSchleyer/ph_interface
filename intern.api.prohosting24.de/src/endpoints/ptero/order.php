<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["packet","productid", "days"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

if (!isset($_POST["discountcode"])) {
    $_POST["discountcode"] = "";
}

$requestData = ["packet" => $_POST["packet"],"productid" => $_POST["productid"],"userid" => $user->getId(), "days" => $_POST["days"], "discountcode" => $_POST["discountcode"]];

foreach ($_POST as $key => $variable) {
    if (strpos($key, 'ptero_') !== false) {
        $requestData[$key] = $variable;
    }
}

$request = requestBackend($config, $requestData, "pteroOrderProduct");

if (isset($request["fail"])) {
    if($request["fail"] == true){
        $response->setfail(true, $request["error"]);
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}