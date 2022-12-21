<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid","street","house_number","plz","city","country"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$sevdeskCountrys = new SevdeskCountrys($dependencyInjector, null);
$sevdeskCountrys = $sevdeskCountrys->getAll(["code" => $_POST["country"]]);
if(count($sevdeskCountrys) != 1){
    $dependencyInjector->getResponse()->fail(1, $dependencyInjector->getLang()->getString("novalidcountry"));
}
$countryID = $sevdeskCountrys[0]->getValue("id");

$invoiceInfo = new InvoiceInfo($dependencyInjector,null);
$info = $invoiceInfo->getAll(["userid" => $_POST["userid"]]);

if(count($info) == 0){
    if(isset($_POST["company_name"])){
        $invoiceInfo->setValue("company_name",htmlspecialchars($_POST["company_name"]));
    } else {
        $invoiceInfo->setValue("company_name","");
    }
    $invoiceInfo->setValue("street",htmlspecialchars($_POST["street"]));
    $invoiceInfo->setValue("house_number",htmlspecialchars($_POST["house_number"]));
    $invoiceInfo->setValue("plz",htmlspecialchars($_POST["plz"]));
    $invoiceInfo->setValue("city",htmlspecialchars($_POST["city"]));
    $invoiceInfo->setValue("userid",$_POST["userid"]);
    $invoiceInfo->setValue("country",$countryID);
    $invoiceInfo->create();
} else {
    if(isset($_POST["company_name"])){
        $info[0]->setValue("company_name",htmlspecialchars($_POST["company_name"]));
    } else {
        $info[0]->setValue("company_name","");
    }
    $info[0]->setValue("street",htmlspecialchars($_POST["street"]));
    $info[0]->setValue("house_number",htmlspecialchars($_POST["house_number"]));
    $info[0]->setValue("plz",htmlspecialchars($_POST["plz"]));
    $info[0]->setValue("city",htmlspecialchars($_POST["city"]));
    $info[0]->setValue("country",$countryID);
    $info[0]->update();
}

$user = new UserNew($dependencyInjector, $_POST["userid"]);

$sevDesk = new SevDeskApiClient($dependencyInjector);
$sevDesk->createUser($user);

$sevDesk->updateContact(
    $user->getValue('sevdeskid'),
    $user->getValue('vorname'),
    $user->getValue('nachname'),
    htmlspecialchars($_POST["street"]),
    htmlspecialchars($_POST["house_number"]),
    htmlspecialchars($_POST["plz"]),
    htmlspecialchars($_POST["city"]),
    htmlspecialchars($countryID),
    htmlspecialchars($_POST["company_name"])
);

$response->setresponse([]);
