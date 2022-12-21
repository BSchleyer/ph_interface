<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);

$user->changeNewsletter(0,$masterdatabase);