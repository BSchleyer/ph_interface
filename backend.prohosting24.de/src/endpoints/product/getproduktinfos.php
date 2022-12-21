<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$responsearray = [];

$produkt = $masterdatabase->select("product_main", [
    "name",
    "price",
], [
    "id" => $_POST["id"],
]);

$responsearray = $produkt[0];


$upgradeoptions = $masterdatabase->select("product_upgrades", [
    "id",
    "name",
], [
    "produktid" => $_POST["id"],
]);
$responsearray["upgrades"] = [];
foreach ($upgradeoptions as $upgradeoption) {
    $responsearray["upgrades"][$upgradeoption["name"]] = [];
    
    $upgradeoptionvalues = $masterdatabase->select("product_upgrade_values", [
        "id",
        "price",
        "data",
        "name",
    ], [
        "upgradeid" => $upgradeoption["id"],
        "ORDER" => ["id" => "ASC"],
    ]);
    $upgradeoptionvalueSorted = [];
    foreach ($upgradeoptionvalues as $upgradeoptionvalue) {
        $upgradeoptionvalueSorted[$upgradeoptionvalue["data"]] = $upgradeoptionvalue;
    }

    ksort($upgradeoptionvalueSorted);

    foreach ($upgradeoptionvalueSorted as $upgradeoptionvalue) {
        array_push($responsearray["upgrades"][$upgradeoption["name"]], ["price" => $upgradeoptionvalue["price"], "id" => $upgradeoptionvalue["id"], "data" => $upgradeoptionvalue["data"], "name" => $upgradeoptionvalue["name"]]);
    }
}

$response->setresponse($responsearray);
