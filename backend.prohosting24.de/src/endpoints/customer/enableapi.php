<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["sessionid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$user = new User();
$user->load_sessionid($masterdatabase, $_POST["sessionid"]);

if ($user->getApikey() != 0) {
    $response->setfail(true, "Die Api ist für diesen Account schon aktiviert");
    return;
}
$apikey = random_str(20);
$user->setApikey($apikey);

$user->save("apikey", $masterdatabase);

$response->setresponse($apikey);
