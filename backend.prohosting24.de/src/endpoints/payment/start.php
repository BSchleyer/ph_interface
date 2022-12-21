<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "amount", "method", "invoice", "closeSuccess"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$_POST["amount"] = str_replace(",", ".", $_POST["amount"]);



if ($_POST["amount"] > (int) $config->getconfigvalue("max_add_amount")) {
    $response->setfail(true, "Sie können maximal 500€ aufladen.");
    return;
}

if ($_POST["amount"] < 1) {
    $response->setfail(true, "Sie müssen mindestens 1€ aufladen.");
    return;
}

$user = new User();
$user->load_id($masterdatabase, $_POST["userid"]);

$payment = new Payment($config,  $dependencyInjector);

if(isset($_POST["donationLink"])){
    $status = $payment->create($_POST["method"], $_POST["amount"], "Prohosting24.de - Guthabenaufladung",0, $masterdatabase, $user, $_POST["closeSuccess"], $_POST["donationLink"]);
} else {
    if($_POST["invoice"] !=  "0"){
        $userNew = new UserNew($dependencyInjector, $_POST["userid"]);
        $sevDeskClient = new SevDeskApiClient($dependencyInjector);

        $invoiceInfo = $sevDeskClient->getInvoice($_POST["invoice"]);
        $contactId = $invoiceInfo["objects"][0]["contact"]["id"];
        if($contactId != $userNew->getValue("sevdeskid")){
            $this->dependencyInjector->getResponse()->fail(403, "Nicht Ihre Rechnung");
        }
        $status = $payment->create($_POST["method"], $invoiceInfo["objects"][0]["sumGross"], "Prohosting24.de - Rechnung - " . $invoiceInfo["objects"][0]["invoiceNumber"],$_POST["invoice"], $masterdatabase, $user,  $_POST["closeSuccess"]);
    } else {
        $status = $payment->create($_POST["method"], $_POST["amount"], "Prohosting24.de - Guthabenaufladung",0, $masterdatabase, $user, $_POST["closeSuccess"]);
    }
}
if (!$status) {
    $response->setfail(true, "Fehler beim erstellen der Zahlung.");
    return;
}

$response->setresponse($status);
