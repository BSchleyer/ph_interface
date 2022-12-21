<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["targetuserid", "serviceid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$servicelist = $masterdatabase->select("service_main", [
    "id",
    "serviceid",
    "produktid",
    "price",
    "discount",
    "expire_at",
], [
    "id" => $_POST["serviceid"],
]);

switch ($servicelist[0]["produktid"]) {
    case 1:
        $masterdatabase->update("service_main", [
            "userid" => $_POST["targetuserid"],
        ], [
            "id" => $_POST["serviceid"],
        ]);
        break;
    case 3:
        $masterdatabase->update("service_main", [
            "userid" => $_POST["targetuserid"],
        ], [
            "id" => $_POST["serviceid"],
        ]);
        $masterdatabase->update("ts3_main", [
            "userid" => $_POST["targetuserid"],
        ], [
            "id" => $servicelist[0]["serviceid"],
        ]);
        break;

    case 2:
        $masterdatabase->update("service_main", [
            "userid" => $_POST["targetuserid"],
        ], [
            "id" => $_POST["serviceid"],
        ]);
        $masterdatabase->update("webspace_main", [
            "userid" => $_POST["targetuserid"],
        ], [
            "id" => $servicelist[0]["serviceid"],
        ]);
        break;

    default:
        $response->setfail(true, "Dieses Produkt kann nicht gewechselt werden");
        return;
        break;
}
