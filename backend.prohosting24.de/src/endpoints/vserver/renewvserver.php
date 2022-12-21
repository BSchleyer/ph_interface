<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "days"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
if (!is_numeric($_POST["days"])) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}
if (strpos($_POST["days"], ',') !== false) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}
if ($_POST["days"] < 1) {
    $response->setfail(true, "Bitte geben Sie eine positive Zahl ein.");
    return;
}
if (strpos($_POST["days"], '.') !== false) {
    $response->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
    return;
}
if ($_POST["days"] > 365) {
    $response->setfail(true, "Es ist nur möglich den Server 1 Jahr zu verlängern.");
    return;
}

$service = $masterdatabase->select("service_main", [
    "userid",
    "price",
    "discount",
    "expire_at",
    "delete_at",
    "id"
], [
    "serviceid" => $_POST["id"],
    "produktid" => 1,
]);

$price = (($service[0]["price"] * (1 - $service[0]["discount"])) / 30) * $_POST["days"];

$user = new User();
$user->load_id($masterdatabase, $service[0]["userid"]);

if(!$user->pay("KVM Server Verlängerung. KVM Server Id: " . $_POST["id"], $price, $dependencyInjector, true, $service[0]["id"])){
    $response->setfail(true, $dependencyInjector->getLang()->getString("notenoughcredit"));
    return;
}

if ($service[0]["delete_at"] != null) {
    $masterdatabase->update("service_main", [
        "expire_email" => 0,
        "expire_at" => date('Y-m-d H:i:s', strtotime(' + ' . $_POST["days"] . ' days')),
        "delete_at" => null,
    ], [
        "serviceid" => $_POST["id"],
        "produktid" => 1,
    ]);
} else {
    $masterdatabase->update("service_main", [
        "expire_email" => 0,
        "expire_at" => date('Y-m-d H:i:s', strtotime($service[0]["expire_at"] . ' + ' . $_POST["days"] . ' days')),
        "delete_at" => null,
    ], [
        "serviceid" => $_POST["id"],
        "produktid" => 1,
    ]);
}

logit($masterdatabase, "vserver_main", "id", $_POST["id"], "Server wurde verlängert. Tage: " . $_POST["days"], $service[0]["userid"], "-");
$response->setresponse("");
sendtodc('VServer Verlängerung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Länge: ' . $_POST["days"] . ' Tage
Kosten: ' . $price . ' €', $config);
