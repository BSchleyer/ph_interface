<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);

if ($user->getIshourly() == 1) {
    $response->setfail(true, "Stündliche Abrechnung ist schon aktiviert");
    return;
}
$user->setIshourly(1);

$user->save("ishourly", $masterdatabase);
