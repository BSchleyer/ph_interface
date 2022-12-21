<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$userverify = new User();

$userverify->load_sessionid($masterdatabase, $_POST["sessionid"]);

$supportpin = random_str(5, "0123456789");
$userverify->setSupportPin($supportpin);
$userverify->save("supportpin", $masterdatabase);
