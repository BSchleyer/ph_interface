


<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["password_old", "password_new", "password_new2"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$apirespond = requestBackend($config, ["userid" => $user->getId(),"password_old" => $_POST["password_old"], "password_new" => $_POST["password_new"], "password_new2" => $_POST["password_new2"]], "savePassword");


if ($apirespond["fail"] == 200) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
