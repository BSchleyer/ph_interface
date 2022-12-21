<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$vserver = $masterdatabase->select("vserver_main", [
    "firstpw",
], [
    "id" => $_POST["id"],
]);
if (count($vserver) != 1) {
    $response->setfail(true, "Dieser KVM Server existiert nicht.");
    return;
}

$response->setresponse($vserver[0]["firstpw"]);
