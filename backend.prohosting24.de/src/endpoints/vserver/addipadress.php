<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["id", "ip"])) {
	$response->setfail(true, "Missing Variable in POST");
	return;
}

$vserver = new VServer($dependencyInjector);
$vserver->loadwithid($_POST["id"]);

$serviceinfos = $masterdatabase->select("service_main", [
	"userid",
	"price",
	"discount",
	"expire_at",
	"upgradeble",
	"id",
], [
	"serviceid" => $_POST["id"],
    "produktid" => 1,
]);
$user = new User();
$user->load_id($masterdatabase, $serviceinfos[0]["userid"]);
$price = $serviceinfos[0]["price"];
$expire = strtotime($serviceinfos[0]["expire_at"]);
$now = time();
$daysleft = floor(($expire - $now) / (24 * 60 * 60));
$ipv4count = count($vserver->getips()[0]);
if($ipv4count >= 10){
    $response->setfail(true, "Sie haben das IPv4-Maximum erreicht.");
    return;
}

$ipupgradepackold = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $ipv4count,
    "upgradeid" => 4,
]);
$ipupgradepack = $masterdatabase->select("product_upgrade_values", [
    "price",
    "name",
    "data",
], [
    "data" => $ipv4count + 1,
    "upgradeid" => 4,
]);

$ipv4cost = ($ipupgradepackold[0]["price"] - $ipupgradepack[0]["price"]);
$ipv4costd = $ipv4cost / 30;
$costnd = round($ipv4costd * $daysleft, 2);
$cost = $costnd * $serviceinfos[0]["discount"];

switch ($_POST["ip"]) {
    case '4':
        $cost = $ipv4costd * $daysleft;
        
        $moneyafter = $user->getGuthaben() - ($cost * -1);
        if ($moneyafter < 0) {
            $response->setfail(true, "Sie haben für dieses Produkt nicht genügend Guthaben");
            return;
        }
        $masterdatabase->update("service_main", [
            "price" => $price + ($ipv4cost * -1),
        ], [
            "serviceid" => $_POST["id"],
            "produktid" => 1,
        ]);
        $user->changeguthaben($masterdatabase, round($cost, 2), "Weitere KVM Server IP Adresse - " . $_POST["id"]);
        $vserver->addipv4adress();
        break;

    default:
        $response->setfail(true, "Diese IP existiert nicht.");
        return;
        break;
}
