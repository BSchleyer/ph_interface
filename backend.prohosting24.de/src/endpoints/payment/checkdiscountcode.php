<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["code", "productid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$discount = new Discount($dependencyInjector, $_POST["code"], "code");
if(!$discount->checkDiscount($_POST["productid"])){
    $response->setfail(true, "Dieser Code existiert nicht");
    return;
}

$response->setresponse(["type" => $discount->getValue('type'), "amount" => $discount->getData()["amount"]]);
